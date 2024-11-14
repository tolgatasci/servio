<x-service-register-layout>
    <x-slot name="style">
        <style>
            .progress-bar {
                height: 100%;
                width: 85%;
                background-color: #4CAF50;
                transition: width 0.4s ease;
            }
            .wizard-step {
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin-bottom: 30px;
                max-width: 600px;
                margin: 0 auto;
                text-align: center;
            }

            /* Başlık Stil */
            h3 {
                font-size: 24px;
                color: #333;
                font-weight: 600;
                margin-bottom: 20px;
            }

            /* Textarea Stil */
            .single-login-field textarea {
                width: 100%;
                padding: 15px;
                font-size: 16px;
                border-radius: 8px;
                border: 1px solid #d1d5db;
                background-color: #f8f9fa;
                transition: border-color 0.3s ease, box-shadow 0.3s ease;
                resize: none;
            }

            .single-login-field textarea:focus {
                border-color: #4CAF50;
                outline: none;
                box-shadow: 0 0 10px rgba(76, 175, 80, 0.2);
            }



        </style>
    </x-slot>
    <form action="{{ route('services.step.introduction.post') }}" method="POST">
        @csrf
        <div class="wizard-step">
            <h3>{{__('Introduce Yourself')}}</h3>
            <x-validation-errors class="errors" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <div class="single-login-field">
                <x-label for="description" value="{{__('Short Introduction Text')}}" />
                <textarea id="description" name="description" rows="5" class="block mt-1 w-full"
                          placeholder="{{__('Write a short description about yourself and the service you provide.')}}"
                          >{{old('description')}}</textarea>
            </div>
            <div class="flex items-center justify-between mt-4">
                <x-button type="button" onclick="window.history.back()">{{__('Back')}}</x-button>
                <x-button type="submit">{{__('Next')}}</x-button>
            </div>
        </div>
    </form>
</x-service-register-layout>
