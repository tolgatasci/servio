<x-service-register-layout>
    <x-slot name="style">
        <style>
            .progress-bar {
                height: 100%;
                width: 50%;
                background-color: #4CAF50;
                transition: width 0.4s ease;
            }
        </style>
    </x-slot>
    <form action="{{ route('services.step.individual.post') }}" method="POST">
        @csrf
        <div class="wizard-step">
            <h3>{{__('Individual Contact Information')}}</h3>
            <x-validation-errors class="errors" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <div class="single-login-field">
                <x-label for="name" value="{{__('Name')}}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            </div>
            <div class="single-login-field">
                <x-label for="surname" value="{{__('Surname')}}" />
                <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required />
            </div>
            <div class="flex items-center justify-between mt-4">
                <x-button type="button" class="button-back" onclick="window.history.back()">{{__('Back')}}</x-button>
                <x-button type="submit" class="button-next">{{__('Next')}}</x-button>
            </div>
        </div>
    </form>
</x-service-register-layout>
