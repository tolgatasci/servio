<x-service-apply-layout>
    <style>
        /* Genel form stili */
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        /* Form kapatma simgesi */
        .form-close {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
            color: #888;
            transition: color 0.3s;
        }

        .form-close:hover {
            color: #ff5e5e;
        }

        /* Form başlık stili */
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 26px;
            font-weight: bold;
        }

        /* Progres çubuğu stili */
        .progress-bar {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 25px;
        }

        .progress-bar-inner {
            height: 12px;
            background-color: #4caf50;
            width: 0;
            transition: width 0.4s ease-in-out;
        }

        /* Adım başlıkları stili */
        .step-title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #444;
        }

        /* Input ve buton stilleri */
        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.3s;
            background-color: #f9f9f9;
        }

        .form-container input[type="text"].input-error,
        .form-container input[type="number"].input-error,
        .form-container select.input-error {
            border-color: #ff5e5e;
            background-color: #ffe6e6;
        }

        .form-container input[type="text"]:focus,
        .form-container input[type="number"]:focus,
        .form-container select:focus {
            border-color: #4caf50;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.3);
        }

        .form-container .btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
            border: none;
            color: white;
            background-color: #007bff;
        }

        .form-container .btn:hover {
            background-color: #0056b3;
        }

        .form-container .btn-secondary {
            background-color: #6c757d;
        }

        .form-container .btn-secondary:hover {
            background-color: #5a6268;
        }

        .form-container .btn-success {
            background-color: #28a745;
        }

        .form-container .btn-success:hover {
            background-color: #218838;
        }

        /* Adımlara göre görünürlük kontrolü */
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        /* Hata mesajı stili */
        .input-error-message {
            color: #ff5e5e;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        /* Form-group label */
        .form-group label {
            text-align: left;
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>

    <div class="form-container">
        <span class="form-close" onclick="confirmExit()">&times;</span>
        <h2 class="form-title">{{ $form->name }}</h2>

        <div class="progress-bar">
            <div id="progress-bar-inner" class="progress-bar-inner" style="width: {{ 100 / count($form->steps) }}%"></div>
        </div>

        <form id="service-application-form" action="{{ route('service.apply.submit', $service->id) }}" method="POST">
            @csrf
            <div id="steps-container">
                @foreach ($form->steps as $stepIndex => $step)
                    <div class="step @if ($stepIndex === 0) active @endif" data-step="{{ $stepIndex }}">
                        <div class="step-title">{{ $step->step_name }}</div>
                        @foreach ($step->fields as $field)
                            <div class="form-group" id="field-group-{{ $field->id }}">
                                <label for="field-{{ $field->id }}">{{ $field->label }}</label>
                                <input id="field-{{ $field->id }}" type="{{ $field->type }}" name="fields[step_{{ $stepIndex }}][{{ $field->id }}]" placeholder="{{ $field->label }}" class="form-control" data-rules="{{ $field->rules }}">
                                <div class="input-error-message" id="error-message-{{ $field->id }}"></div>
                                @error("fields.step_{$stepIndex}.{$field->id}")
                                <div class="input-error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="button-group">
                <button type="button" id="prevBtn" class="btn btn-secondary" onclick="changeStep(-1)" style="display: none;">{{__('Back')}}</button>
                <button type="button" id="nextBtn" class="btn" onclick="changeStep(1)">{{__('Next')}}</button>
                <button type="submit" id="submitBtn" class="btn btn-success" style="display: none;">{{__('Submit Application')}}</button>
            </div>
        </form>
    </div>

    <script>
        let currentStep = 0;
        const steps = document.querySelectorAll(".step");
        const progressBar = document.getElementById("progress-bar-inner");

        function showStep(stepIndex) {
            steps.forEach((step, index) => {
                step.classList.toggle("active", index === stepIndex);
            });

            document.getElementById("prevBtn").style.display = stepIndex === 0 ? "none" : "inline";
            document.getElementById("nextBtn").style.display = stepIndex === steps.length - 1 ? "none" : "inline";
            document.getElementById("submitBtn").style.display = stepIndex === steps.length - 1 ? "inline" : "none";

            const progressWidth = ((stepIndex + 1) / steps.length) * 100;
            progressBar.style.width = progressWidth + "%";
        }

        function changeStep(stepChange) {
            if (stepChange === 1 && !validateCurrentStep()) {
                return;
            }
            currentStep += stepChange;
            if (currentStep < 0) {
                currentStep = 0;
            } else if (currentStep >= steps.length) {
                currentStep = steps.length - 1;
            }
            showStep(currentStep);
        }

        function validateCurrentStep() {
            let isValid = true;
            const currentFields = steps[currentStep].querySelectorAll(".form-control");

            currentFields.forEach(field => {
                const rules = field.getAttribute("data-rules").split('|');  // Kuralları al
                const fieldIdMatch = field.name.match(/\[(\d+)\]$/);
                const fieldId = fieldIdMatch ? fieldIdMatch[1] : null;
                const errorMessage = document.getElementById(`error-message-${fieldId}`);
                let fieldValid = true;
                let message = '';  // Hata mesajını sakla

                rules.forEach(rule => {
                    if (rule === 'required' && !field.value.trim()) {
                        fieldValid = false;
                        message = `${field.getAttribute('placeholder')} {{__('is required.')}}`;  // Zorunlu alan mesajı
                    }
                    if (rule === 'numeric' && isNaN(field.value)) {
                        fieldValid = false;
                        message = `${field.getAttribute('placeholder')} {{__('must be a number.')}}`;  // Sayısal olma durumu için mesaj
                    }
                    // Diğer kurallar eklenebilir: örneğin, min, max, email, vb.
                });

                if (!fieldValid) {
                    field.classList.add("input-error");
                    errorMessage.textContent = message;  // Hata mesajını göster
                    isValid = false;
                } else {
                    field.classList.remove("input-error");
                    errorMessage.textContent = '';  // Hata mesajını temizle
                }
            });

            return isValid;
        }

        function confirmExit() {
            const confirmationModal = document.createElement('div');
            confirmationModal.style.position = 'fixed';
            confirmationModal.style.top = '0';
            confirmationModal.style.left = '0';
            confirmationModal.style.width = '100%';
            confirmationModal.style.height = '100%';
            confirmationModal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
            confirmationModal.style.display = 'flex';
            confirmationModal.style.alignItems = 'center';
            confirmationModal.style.justifyContent = 'center';
            confirmationModal.style.zIndex = '1000';

            confirmationModal.innerHTML = `
                <div style="background: white; padding: 20px; border-radius: 8px; text-align: center; width: 300px;">
                    <p>{{__('Are you sure you want to exit? All unsaved progress will be lost.')}}</p>
                    <div style="margin-top: 20px;">
                        <button onclick="window.location.href='{{ url('/') }}'" style="background-color: #ff5e5e; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">{{__('Exit')}}</button>
                        <button onclick="closeConfirmationModal()" style="background-color: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-left: 10px;">{{__('Continue Editing')}}</button>
                    </div>
                </div>
            `;

            document.body.appendChild(confirmationModal);
        }

        function closeConfirmationModal() {
            const modal = document.querySelector('div[style*="z-index: 1000"]');
            if (modal) {
                modal.remove();
            }
        }

        showStep(currentStep);
    </script>
</x-service-apply-layout>
