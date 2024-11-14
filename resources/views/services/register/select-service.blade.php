<x-service-register-layout>
    <x-slot name="style">
        <style>
            .progress-bar {
                height: 100%;
                width: 20%;
                background-color: #4CAF50;
                transition: width 0.4s ease;
            }
        </style>
    </x-slot>

    <form action="{{ route('services.step.select-service.post') }}" method="POST">
        @csrf

        <h3>{{__('Which service will you provide?')}}</h3>
        <x-validation-errors class="errors" />
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <!-- Select2 İle Geliştirilmiş Selectbox -->
        <div class="single-login-field">
            <label for="service">{{ __('Service Selection') }}</label>
            <select id="service" name="service" class="block mt-1 w-full">
                @foreach($services as $service)
                <option value="{{$service->id}}">{{$service->name}}</option>
                @endforeach
                <!-- Diğer hizmetler -->
            </select>
        </div>
            <div class="flex items-center justify-end mt-4">
                <x-button type="submit" class="wizard-button">{{__('Next')}}</x-button>
            </div>

    </form>
    <x-slot name="script">


        <script>
            $(document).ready(function() {
                // Select2'nin etkinleştirilmesi
                $('#service').select2({
                    placeholder: '{{__('Select Service')}}',
                    allowClear: true
                });
            });
        </script>
    </x-slot>
</x-service-register-layout>
