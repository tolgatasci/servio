<x-guest-layout>
    <style>
        /* Genel form alanı tasarımı */
        .wizard-step {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            max-width: 700px;
            margin: 20px auto;
        }

        /* Başlıklar için tasarım */
        h3 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Radio button ve etiketlerin modern tasarımı */
        .radio-group {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 20px 0;
        }

        .radio-group input[type="radio"] {
            display: none;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            font-size: 18px;
            color: #555;
            cursor: pointer;
            position: relative;
            padding-left: 35px;
            margin-right: 20px;
        }

        .radio-group label::before {
            content: "";
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            background-color: #fff;
        }

        .radio-group input[type="radio"]:checked + label::before {
            border-color: #4CAF50;
            background-color: #4CAF50;
        }

        .radio-group label::after {
            content: "";
            width: 10px;
            height: 10px;
            background-color: white;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%) scale(0);
            transition: transform 0.2s ease-in-out;
        }

        .radio-group input[type="radio"]:checked + label::after {
            transform: translateY(-50%) scale(1);
        }

        /* Input alanı tasarımı */
        .single-login-field input,
        .single-login-field select {
            width: 100%;
            padding: 12px 16px;
            font-size: 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #fdfdfd;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .single-login-field {
            margin-bottom: 20px;
        }

        .single-login-field label {
            display: block;
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
            font-weight: 500;
        }

        /* Focus durumu */
        .single-login-field input:focus,
        .single-login-field select:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.2);
        }

        /* Buton tasarımı */
        button,
        x-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover,
        x-button:hover {
            background-color: #45a049;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Responsive tasarım */
        @media (max-width: 768px) {
            .wizard-step {
                padding: 15px;
                width: 90%;
            }

            h3 {
                font-size: 20px;
            }

            label {
                font-size: 16px;
            }

            button {
                font-size: 14px;
            }
        }


    </style>
    <section class="jobguru-categories-area browse-category-page section_30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="wizard-form">
                        <!-- Adım 1: Hizmet Seçimi -->
                        <div class="wizard-step" id="step-1">
                            <h3>{{ __('Hangi Serviste Hizmet Vereceksiniz?') }}</h3>
                            <div class="single-login-field">
                                <x-label for="service" value="{{ __('Service Selection') }}" />
                                <select id="service" name="service" class="block mt-1 w-full">
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <x-button type="button" class="ml-4" id="next-step-1">
                                    {{ __('Next') }}
                                </x-button>
                            </div>
                        </div>

                        <!-- Adım 2: Şahıs/Şirket Seçimi -->
                        <div class="wizard-step hidden" id="step-2">
                            <h3>{{ __('Şahıs mı, Şirket mi?') }}</h3>
                            <div class="single-login-field radio-group">
                                <input type="radio" id="individual" name="entity_type" value="individual" checked>
                                <label for="individual">{{ __('Şahıs') }}</label>

                                <input type="radio" id="company" name="entity_type" value="company">
                                <label for="company">{{ __('Şirket') }}</label>
                            </div>
                            <div class="flex items-center justify-between mt-4">
                                <x-button type="button" class="ml-4" id="prev-step-2">
                                    {{ __('Geri') }}
                                </x-button>
                                <x-button type="button" class="ml-4" id="next-step-2">
                                    {{ __('İleri') }}
                                </x-button>
                            </div>
                        </div>

                        <!-- Adım 3: Şahıs veya Şirket Bilgileri -->
                        <div class="wizard-step hidden" id="step-3">
                            <!-- Şahıs için Form -->
                            <div id="individual-form">
                                <h3>{{ __('Şahıs Bilgileri') }}</h3>
                                <div class="single-login-field">
                                    <x-label for="name" value="{{ __('Ad Soyad') }}" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                                </div>
                                <div class="single-login-field">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                </div>
                            </div>

                            <!-- Şirket için Form -->
                            <div id="company-form" class="hidden">
                                <h3>{{ __('Şirket Bilgileri') }}</h3>
                                <div class="single-login-field">
                                    <x-label for="company_name" value="{{ __('Şirket Adı') }}" />
                                    <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" />
                                </div>
                                <div class="single-login-field">
                                    <x-label for="phone" value="{{ __('Telefon Numarası') }}" />
                                    <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
                                </div>
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                <x-button type="button" class="ml-4" id="prev-step-3">
                                    {{ __('Geri') }}
                                </x-button>
                                <x-button type="button" id="submit-form" class="ml-4">
                                    {{ __('Kaydet') }}
                                </x-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        $(document).ready(function () {
            // Adım değişkenleri
            let currentStep = 1;

            // Adım 1: Hizmet seçimini gönder
            $('#next-step-1').on('click', function () {
                let service = $('#service').val();

                $.ajax({
                    url: "{{ route('services.forms.step-one.post') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        service: service
                    },
                    success: function (response) {
                        if (response.success) {
                            showStep(2);
                        }
                    },
                    error: function (response) {
                        alert('Hizmet seçimini doğrulayın');
                    }
                });
            });

            // Adım 2: Şahıs/Şirket seçimini gönder
            $('#next-step-2').on('click', function () {
                let entityType = $('input[name="entity_type"]:checked').val();

                $.ajax({
                    url: "{{ route('services.forms.step-two.post') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        entity_type: entityType
                    },
                    success: function (response) {
                        if (response.success) {
                            if (entityType === 'company') {
                                $('#company-form').removeClass('hidden');
                                $('#individual-form').addClass('hidden');
                            } else {
                                $('#individual-form').removeClass('hidden');
                                $('#company-form').addClass('hidden');
                            }
                            showStep(3);
                        }
                    },
                    error: function (response) {
                        alert('Şahıs mı Şirket mi seçimini doğrulayın');
                    }
                });
            });

            // Adım 3: Bilgileri kaydet
            $('#submit-form').on('click', function () {
                let name = $('#name').val();
                let email = $('#email').val();
                let password = $('#password').val();
                let passwordConfirmation = $('#password_confirmation').val();
                let companyName = $('#company_name').val();
                let phone = $('#phone').val();

                $.ajax({
                    url: "{{ route('services.forms.step-three.post') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        email: email,
                        password: password,
                        password_confirmation: passwordConfirmation,
                        company_name: companyName,
                        phone: phone
                    },
                    success: function (response) {
                        if (response.success) {
                            window.location.href = "{{ route('home') }}";
                        }
                    },
                    error: function (response) {
                        alert('Lütfen bilgileri doğru girin');
                    }
                });
            });

            // Geri butonları
            $('#prev-step-2').on('click', function () {
                showStep(1);
            });

            $('#prev-step-3').on('click', function () {
                showStep(2);
            });

            // Adım değiştirme fonksiyonu
            function showStep(step) {
                $('.wizard-step').each(function (index, element) {
                    if (index + 1 === step) {
                        $(element).removeClass('hidden');
                    } else {
                        $(element).addClass('hidden');
                    }
                });
            }
        });
    </script>
</x-guest-layout>
