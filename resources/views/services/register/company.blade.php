<x-service-register-layout>
    <x-slot name="style">
        <style>
            .progress-bar {
                height: 100%;
                width: 50%;
                background-color: #4CAF50;
                transition: width 0.4s ease;
            }

            /* Styling for select box */
            select {
                width: 100%;
                padding: 12px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 4px;
                background-color: #f8f9fa;
                background-image: none;
                appearance: none;
                -webkit-appearance: none;
                -moz-appearance: none;
            }

            /* General form styling */
            .single-login-field input,
            .single-login-field select {
                width: 100%;
                padding: 12px;
                font-size: 16px;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                background-color: #fdfdfd;
                transition: border-color 0.3s ease, box-shadow 0.3s ease;
            }

            /* Radio button styling */
            .radio-group {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .radio-group input[type="radio"] {
                display: none;
            }

            .radio-group label {
                display: inline-flex;
                align-items: center;
                font-size: 16px;
                color: #555;
                margin-right: 10px;
                cursor: pointer;
            }

            .radio-group label span {
                display: inline-block;
                width: 20px;
                height: 20px;
                margin-right: 8px;
                border-radius: 50%;
                border: 2px solid #ccc;
                position: relative;
                transition: border-color 0.3s ease;
            }

            .radio-group input[type="radio"]:checked + span {
                border-color: #4CAF50;
            }

            .radio-group input[type="radio"]:checked + span::before {
                content: '';
                display: block;
                width: 12px;
                height: 12px;
                background-color: #4CAF50;
                border-radius: 50%;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            /* Checkbox styles */
            input[type="checkbox"] {
                width: 20px;
                height: 20px;
                border: 2px solid #ccc;
                border-radius: 4px;
                cursor: pointer;
                margin-right: 10px;
                appearance: none;
            }

            input[type="checkbox"]:checked {
                background-color: #4CAF50;
                border-color: #4CAF50;
            }

            input[type="checkbox"]:checked::before {
                content: '✓';
                color: white;
                display: block;
                text-align: center;
                font-size: 16px;
                line-height: 20px;
            }

            /* Form button styling */
            .flex-container {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }

            button {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            button:disabled {
                background-color: #ccc;
                cursor: not-allowed;
            }
        </style>
    </x-slot>
    <form action="{{ route('services.step.company.post') }}" method="POST">
        @csrf
        <div class="wizard-step">
            <h3>{{__('Company Contact Information')}}</h3>
            <x-validation-errors class="errors" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <div class="single-login-field">
                <x-label for="company_name" value="{{__('Company Name')}} {{__('(required)')}}" />
                <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required />
            </div>
            <div class="single-login-field">
                <x-label for="salutation" value="{{ __('Salutation (Mr/Ms)') }}" />
                <select id="salutation" name="salutation" class="block mt-1 w-full">
                    <option value="Mr">{{ __('Mr') }}</option>
                    <option value="Ms">{{ __('Ms') }}</option>
                </select>
            </div>

            <div class="single-login-field">
                <x-label for="contact_person" value="{{ __('Contact Person') }} {{__('(required)')}}" />
                <x-input id="contact_person" class="block mt-1 w-full" type="text" name="contact_person" :value="old('contact_person')" required />
            </div>


            <div class="single-login-field">
                <x-label for="phone" value="{{ __('Phone Number') }} {{__('(required)')}}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
            </div>

            <div class="single-login-field">
                <x-label for="fax" value="{{ __('Fax Number') }}" />
                <x-input id="fax" class="block mt-1 w-full" type="text" name="fax" :value="old('fax')" />
            </div>

            <div class="single-login-field">
                <x-label for="website" value="{{ __('Website') }}" />
                <x-input id="website" class="block mt-1 w-full" type="text" name="website" :value="old('website')" />
            </div>

            <div class="flex-container">
                <label class="radio-group">
                    <input type="checkbox" name="large_company" value="yes">
                    <span></span>
                    {{ __('We are a large company.') }}
                </label>

                <label class="radio-group">
                    <input type="checkbox" name="specialized_provider" value="yes">
                    <span></span>
                    {{ __('We are a specialized service provider.') }}
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <x-button type="button" class="button-back" onclick="window.history.back()">{{__('Back')}}</x-button>
                <x-button type="submit" class="button-next">{{__('Next')}}</x-button>
            </div>
        </div>
    </form>
</x-service-register-layout>
