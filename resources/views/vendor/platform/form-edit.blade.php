@extends('platform::app')



@section('content')

    <style>
        /* Form genel yapısı */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .form-container {

            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Başlık stili */
        .form-container h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
            text-align: center;
        }

        /* Her adım için kutu */
        .step-section {
            padding: 0;
            background-color: #fff;
            margin-bottom: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* Adım başlığı */
        .step-title {
            font-size: 20px;
            margin: 0;
            color: #007BFF;
            border-left: 5px solid #007BFF;
            padding: 15px;
            cursor: pointer;
            background-color: #f1f1f1;
        }

        /* Accordion'da içerik alanı */
        .step-content {
            padding: 15px;
            display: none; /* Tüm step-content alanları başlangıçta kapalı olacak */
        }

        /* Input alanları stili */
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            transition: border-color 0.3s;
            background-color: #f8f9fa;
        }

        /* Select box görünümü düzeltme */
        select {
            color: #000;
            font-weight: normal;
        }

        input[type="text"]:focus, input[type="number"]:focus, select:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }

        /* Fieldler arasındaki çizgi ayırıcı */
        .field-block {
            padding: 15px;
            background-color: #f1f1f1;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
        }

        /* Butonlar */
        .form-container .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #4CAF50;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #007BFF;
            border: none;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #0056b3;
        }

        .btn-grey {
            background-color: #6c757d;
            border: none;
            color: white;
        }

        .btn-grey:hover {
            background-color: #5a6268;
        }

        /* Buton grubunu sola hizalama */
        .button-group {
            text-align: center;
            margin-top: 20px;
        }

        /* Form başlığı */
        .form-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        /* Açılan/kapanan simgeler */
        .step-title::after {
            content: '▼'; /* Açıkken aşağı oka benzer bir işaret */
            float: right;
            font-size: 20px;
        }

        .step-section.active .step-title::after {
            content: '▲'; /* Kapalıyken yukarı oka benzer bir işaret */
        }

        /* Field başlığı */
        .field-title::after {
            content: '▼'; /* Başlangıçta kapalı */
            float: right;
            font-size: 18px;
        }

        .field-block.active .field-title::after {
            content: '▲'; /* Kapalıyken yukarı oka benzer bir işaret */
        }

        .field-content {
            display: none; /* Başlangıçta kapalı olacak */
        }

        .toggle {
            align-items: center;
            border-radius: 100px;
            display: flex;
            font-weight: 700;
            margin-bottom: 16px;
        }
        .toggle:last-of-type {
            margin: 0;
        }

        .toggle__input {
            clip: rect(0 0 0 0);
            clip-path: inset(50%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }
        .toggle__input:not([disabled]):active + .toggle-track, .toggle__input:not([disabled]):focus + .toggle-track {
            border: 1px solid transparent;
            box-shadow: 0px 0px 0px 2px #121943;
        }
        .toggle__input:disabled + .toggle-track {
            cursor: not-allowed;
            opacity: 0.7;
        }

        .toggle-track {
            background: #e5e6ef;
            border: 1px solid #5a72b5;
            border-radius: 100px;
            cursor: pointer;
            display: flex;
            height: 30px;
            margin-right: 12px;
            position: relative;
            width: 60px;
        }

        .toggle-indicator {
            align-items: center;
            background: #121943;
            border-radius: 24px;
            bottom: 2px;
            display: flex;
            height: 24px;
            justify-content: center;
            left: 2px;
            outline: solid 2px transparent;
            position: absolute;
            transition: 0.25s;
            width: 24px;
        }

        .checkMark {
            fill: #fff;
            height: 20px;
            width: 20px;
            opacity: 0;
            transition: opacity 0.25s ease-in-out;
        }

        .toggle__input:checked + .toggle-track .toggle-indicator {
            background: #121943;
            transform: translateX(30px);
        }
        .toggle__input:checked + .toggle-track .toggle-indicator .checkMark {
            opacity: 1;
            transition: opacity 0.25s ease-in-out;
        }

        @media screen and (-ms-high-contrast: active) {
            .toggle-track {
                border-radius: 0;
            }
        }


    </style>

    <div class="form-container">
        <h2 class="form-title">{{ __('Edit Form') }}</h2>

        <form action="{{ route('platform.forms.save', $form->id) }}" method="POST">
            @method('POST')
            @csrf



            <!-- Form Name -->
            <div class="mb-4">
                <label for="form_name">{{ __('Form Name') }}</label>
                <input type="text" name="form_name" class="form-control" value="{{ $form->name }}" required>
            </div>

            <!-- Steps and Fields -->
            <div id="steps-container">
                @foreach ($form->steps as $index => $step)
                    <div class="step-section" data-index="{{ $index }}">
                        <h4 class="step-title step-title-text">{{ $step->step_name ?: 'Unknown Step Name' }}
                            <span class="delete-step" data-index="{{ $index }}" style="float: right; cursor: pointer; color: red; font-size: 20px;">✖️</span>
                        </h4>
                        <div class="step-content">
                            <input type="text" name="steps[{{ $index }}][step_name]" class="form-control step-name-input" value="{{ $step->step_name }}" required>

                            <div class="input-fields" data-step="{{ $index }}">
                                @foreach ($step->fields as $fieldIndex => $field)
                                    <div class="field-block" data-index="{{ $fieldIndex }}">
                                        <h5 class="field-title">{{ $field->label ?: 'Unknown Field Name' }}
                                            <span class="delete-field" data-step="{{ $index }}" data-index="{{ $fieldIndex }}" style="float: right; cursor: pointer; color: red; font-size: 18px;">✖️</span>
                                        </h5>
                                        <div class="field-content">
                                            <label class="form-label">Field Label</label>
                                            <input type="text" name="steps[{{ $index }}][fields][{{ $fieldIndex }}][label]" class="form-control" value="{{ $field->label }}">

                                            <label class="form-label">Field Type</label>
                                            <select name="steps[{{ $index }}][fields][{{ $fieldIndex }}][type]" class="form-control">
                                                <option value="text" @if($field->type == 'text') selected @endif>Text</option>
                                                <option value="number" @if($field->type == 'number') selected @endif>Number</option>
                                                <option value="select" @if($field->type == 'select') selected @endif>Select</option>
                                                <option value="range" @if($field->type == 'range') selected @endif>Range</option>
                                                <option value="date" @if($field->type == 'date') selected @endif>Date</option>
                                                <option value="checkbox" @if($field->type == 'checkbox') selected @endif>Checkbox</option>
                                                <option value="textarea" @if($field->type == 'textarea') selected @endif>Textarea</option>
                                            </select>

                                            <label class="form-label">{{ __('Validation Rules') }}</label>
                                            <input type="text" name="steps[{{ $index }}][fields][{{ $fieldIndex }}][rules]" value="{{ $field->rules }}" class="form-control">


                                            <div style="margin:25px" class="mb-4">
                                                <label class="toggle" for="publish_{{ $index }}{{ $fieldIndex }}">
                                                    <input   @if($field->publish) checked @endif type="checkbox" name="steps[{{ $index }}][fields][{{ $fieldIndex }}][publish]" class="toggle__input" id="publish_{{ $index }}{{ $fieldIndex }}" value="1" />
                                                    <span class="toggle-track">
				<span class="toggle-indicator">
					<!-- 	This check mark is optional	 -->
					<span class="checkMark">
						<svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
							<path d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z"></path>
						</svg>
					</span>
				</span>
			</span>
                                                    {{__('Publish Email')}}
                                                </label>
                                            </div>






                                            <!-- Other Config Butonu -->
                                            <button type="button" class="btn btn-grey other-config" data-step="{{ $index }}" data-field="{{ $fieldIndex }}">Other Config</button>

                                            <!-- Hidden Input for Config -->
                                            <input type="hidden" name="steps[{{ $index }}][fields][{{ $fieldIndex }}][config]" value="{{ json_encode($field->other_config, JSON_PRETTY_PRINT) ?? '{}' }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Add Input Button -->
                            <button type="button" class="btn btn-secondary add-input" data-step="{{ $index }}">Add Input Field</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Add Step Button -->
            <button type="button" id="add-step" class="btn btn-primary">Add Step</button>
            <div style="margin:25px" class="mb-4">
                <label class="toggle" for="private_check">
                    <input   @if($form->private_form) checked @endif type="checkbox" name="private_check" class="toggle__input" id="private_check" value="1" />
                    <span class="toggle-track">
				<span class="toggle-indicator">
					<!-- 	This check mark is optional	 -->
					<span class="checkMark">
						<svg viewBox="0 0 24 24" id="ghq-svg-check" role="presentation" aria-hidden="true">
							<path d="M9.86 18a1 1 0 01-.73-.32l-4.86-5.17a1.001 1.001 0 011.46-1.37l4.12 4.39 8.41-9.2a1 1 0 111.48 1.34l-9.14 10a1 1 0 01-.73.33h-.01z"></path>
						</svg>
					</span>
				</span>
			</span>
                   {{__('Private Form')}}
                </label>
            </div>
            <!-- Private Form -->
            <div @if(!$form->private_form) style="display:none;" @endif class="private_form">
                <label for="form_name">{{ __('Blade Name') }}</label>
                <input type="text" name="blade_name" class="form-control" value="{{ $form->blade_name }}" >
            </div>
            <!-- Submit Button -->
            <div class="button-group">
                <button type="submit" class="btn btn-success">{{ __('Save Form') }}</button>
            </div>
        </form>
    </div>

    <!-- Modal Yapısı -->
    <div id="configModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h4>Other Config</h4>
            <textarea id="configTextarea" rows="10" style="width: 100%;"></textarea>
            <br>
            <button type="button" id="saveConfig" class="btn btn-primary">Save Config</button>
        </div>
    </div>

@endsection



@push('scripts')
    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- jQuery UI CDN -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>

        function initializeFormEvents() {
            var modal = document.getElementById("configModal");
            var span = document.getElementsByClassName("close")[0];
            var currentField = null;
            var currentStep = null;

            // Other Config butonuna tıklanınca modal açılır
            $(document).on('click', '.other-config', function () {
                currentField = $(this).data('field');
                currentStep = $(this).data('step');
                var configField = $('input[name="steps[' + currentStep + '][fields][' + currentField + '][config]"]');
                $('#configTextarea').val(configField.val()); // Mevcut config'i modal içindeki textarea'ya yükler
                modal.style.display = "block";
            });

            // Modal kapanma işlevi
            span.onclick = function () {
                modal.style.display = "none";
            }

            // Modal dışında tıklama ile kapanma
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            // Config kaydedilince hidden input'a yazılır
            $('#saveConfig').on('click', function() {
                var configField = $('input[name="steps[' + currentStep + '][fields][' + currentField + '][config]"]');
                configField.val($('#configTextarea').val()); // Modal'daki veriyi gizli input alanına kaydet
                modal.style.display = "none";
            });
        }
        $(document).ready(function() {
            initializeFormEvents(); // Sayfa ilk yüklendiğinde form olaylarını başlat

            // Form submit işlemi gerçekleştiğinde olayları tekrar başlat
            $('form').on('submit', function() {
                setTimeout(function() {
                    initializeFormEvents();
                }, 100); // 100ms gecikmeyle olayları tekrar başlat
            });
        });
        document.addEventListener('turbo:load', function () {
            if (!window.eventListenersAttached) {
                var stepIndex = {{ $form->steps->count() }};
                window.inputIndex = {};
                var modal = document.getElementById("configModal");
                var span = document.getElementsByClassName("close")[0];
                var currentField = null;
                var currentStep = null;


                $('#private_check').change(function() {

                    if (this.checked) {
                       $('.private_form').show();
                        $(".private_form input").prop('required',true);

                    }else{
                        $('.private_form').hide();
                        $('.private_form input').removeAttr('required');
                    }
                });



                // Mevcut adımlar ve alanların indekslerini al
                $('.step-section').each(function() {
                    var step = $(this).data('index');
                    window.inputIndex[step] = $(this).find('.field-block').length;
                });

                // Step adını dinamik olarak güncellemek için input olayını bağlayalım
                $(document).on('keyup', '.step-name-input', function() {
                    var stepName = $(this).val().trim();
                    var stepTitle = stepName ? stepName : 'Unknown Step Name';
                    $(this).closest('.step-section').find('.step-title-text').text(stepTitle);
                });

                // Field label'ı dinamik olarak güncellemek için input olayını bağlayalım
                $(document).on('keyup', 'input[name^="steps"][name$="[label]"]', function() {
                    var fieldLabel = $(this).val().trim();
                    var fieldTitle = fieldLabel ? fieldLabel : 'Unknown Field Name';
                    $(this).closest('.field-block').find('.field-title-text').text(fieldTitle);
                });

                // Step açma-kapama işlevi
                $(document).on('click', '.step-title', function() {
                    var $stepSection = $(this).closest('.step-section');
                    var $stepContent = $stepSection.find('.step-content');

                    $('.step-content').not($stepContent).slideUp();
                    $('.step-section').not($stepSection).removeClass('active');

                    $stepContent.slideToggle();
                    $stepSection.toggleClass('active');
                });

                // Other Config butonuna tıklanınca modal açılır
                $(document).on('click', '.other-config', function () {
                    currentField = $(this).data('field');
                    currentStep = $(this).data('step');
                    var configField = $('input[name="steps[' + currentStep + '][fields][' + currentField + '][config]"]');
                    $('#configTextarea').val(configField.val()); // Mevcut config'i modal içindeki textarea'ya yükler
                    modal.style.display = "block";
                });

                // Modal kapanma işlevi
                span.onclick = function () {
                    modal.style.display = "none";
                }

                // Modal dışında tıklama ile kapanma
                window.onclick = function (event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }

                // Config kaydedilince hidden input'a yazılır
                $('#saveConfig').on('click', function() {
                    var configField = $('input[name="steps[' + currentStep + '][fields][' + currentField + '][config]"]');
                    configField.val($('#configTextarea').val()); // Modal'daki veriyi gizli input alanına kaydet
                    modal.style.display = "none";
                });

                // Adım ekleme
                $(document).on('click', '#add-step', function() {
                    $('.step-content').slideUp();
                    $('.step-section').removeClass('active');

                    var stepHtml = `
                    <div class="step-section active" data-index="${stepIndex}">
                        <h4 class="step-title"><span class="step-title-text">Unknown Step Name</span>
                            <span class="delete-step" data-index="${stepIndex}" style="float: right; cursor: pointer; color: red; font-size: 20px;">✖️</span>
                        </h4>
                        <div class="step-content" style="display: block;">
                            <input type="text" name="steps[${stepIndex}][step_name]" class="form-control step-name-input" placeholder="Step Name" required>
                            <div class="input-fields sortable-fields" data-step="${stepIndex}"></div>
                            <button type="button" class="btn btn-secondary add-input" data-step="${stepIndex}">Add Input Field</button>
                        </div>
                    </div>`;
                    $('#steps-container').append(stepHtml);
                    window.inputIndex[stepIndex] = 0;
                    stepIndex++;
                    makeSortable();
                });

                // Input alanı ekleme
                $(document).on('click', '.add-input', function() {
                    var step = $(this).data('step');
                    $('.field-content').slideUp();
                    $('.field-block').removeClass('active');

                    var inputHtml = `
                    <div class="field-block active" data-index="${window.inputIndex[step]}">
                        <h5 class="field-title"><span class="field-title-text">Unknown Field Name</span>
                            <span class="delete-field" data-step="${step}" data-index="${window.inputIndex[step]}" style="float: right; cursor: pointer; color: red; font-size: 18px;">✖️</span>
                        </h5>
                        <div class="field-content" style="display: block;">
                            <label class="form-label">Field Label</label>
                            <input type="text" name="steps[${step}][fields][${window.inputIndex[step]}][label]" class="form-control field-label-input">

                            <label class="form-label">Field Type</label>
                            <select name="steps[${step}][fields][${window.inputIndex[step]}][type]" class="form-control">
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="select">Select</option>
                                <option value="range">Range</option>
                                <option value="date">Date</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="textarea">Textarea</option>
                            </select>

                            <label class="form-label">Validation Rules</label>
                            <input type="text" name="steps[${step}][fields][${window.inputIndex[step]}][rules]" class="form-control">
                        </div>
                    </div>`;
                    $(this).siblings('.input-fields').append(inputHtml);
                    window.inputIndex[step]++;
                    makeSortable();
                });

                // Step silme işlevi
                $(document).on('click', '.delete-step', function() {
                    var stepIndex = $(this).data('index');
                    $('.step-section[data-index="' + stepIndex + '"]').remove();
                });

                // Field silme işlevi
                $(document).on('click', '.delete-field', function() {
                    var stepIndex = $(this).data('step');
                    var fieldIndex = $(this).data('index');
                    $('.step-section[data-index="' + stepIndex + '"] .field-block[data-index="' + fieldIndex + '"]').remove();
                });

                // Field açma-kapama işlevi
                $(document).on('click', '.field-title', function() {
                    var $fieldBlock = $(this).closest('.field-block');
                    var $fieldContent = $fieldBlock.find('.field-content');

                    $('.field-content').not($fieldContent).slideUp();
                    $('.field-block').not($fieldBlock).removeClass('active');

                    $fieldContent.slideToggle();
                    $fieldBlock.toggleClass('active');
                });

                // Step ve Field'leri sıralanabilir yap
                function makeSortable() {
                    $('#steps-container').sortable({
                        handle: '.step-title',
                        update: function(event, ui) {
                            // Sıralama sonrası gerekli işlevler burada
                        }
                    });

                    $('.sortable-fields').sortable({
                        handle: '.field-title',
                        update: function(event, ui) {
                            // Sıralama sonrası gerekli işlevler burada
                        }
                    });
                }

                makeSortable();
                initializeFormEvents();

                // Olay dinleyicilerinin tekrar eklenmemesi için kontrol değişkeni
                window.eventListenersAttached = true;
            }



        });


    </script>
@endpush
