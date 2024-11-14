<x-service-register-layout>
    <x-slot name="style">
        <style>
            .progress-bar {
                height: 100%;
                width: 60%;
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
        </style>
    </x-slot>
    <form action="{{ route('services.step.select_address.post') }}" method="POST">
        @csrf
        <div class="wizard-step">

            <h3>{{__('Where do you provide service?')}}</h3>
            <x-validation-errors class="errors" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <!-- Country selection -->
            <div class="single-login-field">
                <x-label for="country" value="{{__('Country')}}" />
                <select id="country" name="country" class="block mt-1 w-full">
                    @foreach($countries as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>
            <div class="single-login-field">
                <x-label for="city" value="{{__('City')}}" />
                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required />
            </div>
            <div class="single-login-field">
                <x-label for="district" value="{{__('District')}}" />
                <x-input id="district" class="block mt-1 w-full" type="text" name="district" :value="old('district')" required />
            </div>
            <!-- District selection (Dynamic based on selected city) -->

            <div class="flex items-center justify-between mt-4">
                <x-button type="button" class="button-back" onclick="window.history.back()">{{__('Back')}}</x-button>
                <x-button type="submit" class="button-next">{{__('Next')}}</x-button>
            </div>
        </div>
    </form>

    <x-slot name="script">

    </x-slot>
</x-service-register-layout>
