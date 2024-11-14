<x-service-register-layout>
    <x-slot name="style">
        <style>
            .progress-bar {
                height: 100%;
                width: 30%;
                background-color: #4CAF50;
                transition: width 0.4s ease;
            }
        </style>
    </x-slot>
    <form action="{{ route('services.step.select_entity_type.post') }}" method="POST">
        @csrf
        <div class="wizard-step">
            <h3>{{__('Are You Individual or Company?')}}</h3>
            <x-validation-errors class="errors" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <div class="single-login-field radio-group">
                <label>
                    <input type="radio" name="entity_type" value="individual" checked>
                    <span class="custom-radio"></span>
                    {{ __('Individual') }}
                </label>
                <label>
                    <input type="radio" name="entity_type" value="company">
                    <span class="custom-radio"></span>
                    {{ __('Company') }}
                </label>
            </div>
            <div class="flex items-center justify-between mt-4">
                <x-button type="button" class="button-back" onclick="window.history.back()">{{__('Back')}}</x-button>
                <x-button type="submit" class="button-next">{{__('Next')}}</x-button>
            </div>
        </div>
    </form>
</x-service-register-layout>
