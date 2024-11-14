<x-guest-layout>
    <x-authentication-card>
    <style>textarea {
            width: 100%; /* Diğer input alanlarıyla aynı genişlikte olacak */
            height: 150px; /* Daha geniş bir yükseklik ayarlayarak yazı alanını genişlet */
            padding: 10px; /* İç boşluk ekleyin */
            font-size: 16px; /* Yazı tipi büyüklüğünü diğer input alanlarıyla uyumlu yapın */
            border-radius: 5px; /* Köşeleri yuvarlayarak daha hoş bir görünüm sağlayın */
            border: 1px solid #d1d5db; /* Gri tonlarda kenar çerçevesi ekleyin */
            outline: none; /* Focus olduğunda etrafında mavi bir çizgi oluşmasını engelleyin */
            resize: none; /* Yeniden boyutlandırmayı kapatın */
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); /* Hafif iç gölge vererek derinlik katın */
        }

        textarea:focus {
            border-color: #6b7280; /* Focus (tıklanmış) olduğunda kenar rengi değişsin */
        }
        .success-message {
            color: #28a745; /* Yeşil renk (Bootstrap'teki success yeşili) */
            background-color: #d4edda; /* Açık yeşil arka plan */
            border: 1px solid #c3e6cb; /* Daha koyu bir yeşil kenarlık */
            padding: 10px 15px; /* İç boşluk */
            border-radius: 5px; /* Köşeleri yuvarlat */
            font-size: 14px; /* Yazı büyüklüğü */
            font-weight: 500; /* Yazı kalınlığı */
            margin-bottom: 20px; /* Alt boşluk */
            max-width: 100%; /* Tam genişlikte */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Hafif gölge efekti */
        }

        .success-message::before {
            content: '✔️ '; /* Mesaj başına bir onay işareti ekliyoruz */
            margin-right: 5px; /* Onay işareti ile yazı arasında boşluk */
        }

    </style>
        <!-- Contact Form Area Start -->
        <section class="jobguru-login-area section_30">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="login-box">
                            <div class="login-title">
                                <h3>{{ __('Contact Us') }}</h3>
                            </div>

                            <!-- Validation Errors -->
                            <x-validation-errors class="errors" />

                            @if (session('success'))
                                <div class="success-message">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <!-- Contact Form -->
                            <form method="POST" action="{{ route('contact.store') }}">
                                @csrf

                                <!-- Name -->
                                <div class="single-login-field">
                                    <x-label for="name" value="{{ __('Name') }}" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                </div>

                                <!-- Email -->
                                <div class="single-login-field">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                </div>

                                <!-- Subject -->
                                <div class="single-login-field">
                                    <x-label for="subject" value="{{ __('Subject') }}" />
                                    <x-input id="subject" class="block mt-1 w-full" type="text" name="subject" :value="old('subject')" required />
                                </div>

                                <!-- Message -->
                                <div class="single-login-field">
                                    <x-label for="message" value="{{ __('Message') }}" />
                                    <textarea id="message" name="message" class="block mt-1 w-full" rows="5" required>{{ old('message') }}</textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="single-login-field">
                                    <x-button class="ml-4">
                                        {{ __('Send Message') }}
                                    </x-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Form Area End -->

    </x-authentication-card>
</x-guest-layout>
