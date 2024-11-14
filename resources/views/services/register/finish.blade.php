<x-service-register-layout>
    <x-slot name="style">
        <style>
            .progress-bar {
                height: 100%;
                width: 100%;
                background-color: #4CAF50;
                transition: width 0.4s ease;
            }

            .success-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 10px;
                background-color: #f9f9f9;
                margin-top: 30px;
            }

            .success-container img {
                width: 150px;
                height: auto;
                margin-bottom: 20px;
            }

            h3 {
                font-size: 24px;
                font-weight: bold;
                color: #333;
                margin-bottom: 10px;
                text-align: center;
            }

            p {
                font-size: 16px;
                color: #666;
                text-align: center;
                margin-bottom: 20px;
            }

            .success-button {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .success-button:hover {
                background-color: #45a049;
            }
        </style>
    </x-slot>

    <form action="{{ route('services.step.finish.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="wizard-step">
            <div class="success-container">
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <!-- Success Message -->
            <h3>{{ __('Welcome to WayToFairs!') }}</h3>
            <p>{{ __('Your profile has been successfully created. You can now start reviewing incoming service offers.') }}</p>



            <div class="flex items-center justify-between mt-4">

                <x-button type="submit">{{__('HOME PAGE')}}</x-button>
            </div>
        </div>
        </div>
    </form>

    <x-slot name="script">

    </x-slot>
</x-service-register-layout>
