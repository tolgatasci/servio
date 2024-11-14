<x-service-register-layout>
    <x-slot name="style">
        <style>
            .progress-bar {
                height: 100%;
                width: 80%;
                background-color: #4CAF50;
                transition: width 0.4s ease;
            }
            /* Styling for file input */
            .custom-file-upload {
                display: inline-block;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                border: 2px solid #4CAF50;
                color: #4CAF50;
                background-color: #fff;
                border-radius: 5px;
                transition: background-color 0.3s, color 0.3s;
                text-align: center;
            }

            .custom-file-upload:hover {
                background-color: #4CAF50;
                color: white;
            }

            /* Hide default file input */
            input[type="file"] {
                display: none;
            }

            /* Thumbnail preview styling */
            .preview-images {
                display: flex;
                gap: 15px;
                flex-wrap: wrap;
                margin-top: 20px;
            }

            .preview-images img {
                width: 100px;
                height: 100px;
                object-fit: cover;
                border-radius: 5px;
                border: 2px solid #d1d5db;
            }

            .preview-images img:hover {
                border-color: #4CAF50;
            }

            .flex {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        </style>
    </x-slot>
    <form action="{{ route('services.step.upload_profil_photo.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="wizard-step">
            <h3>{{__('Upload Your Profil Photo')}}</h3>
            <x-validation-errors class="errors" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <!-- Custom File Upload Button -->
            <div class="single-login-field">
                <label for="photo" class="custom-file-upload">
                    {{__('Select Photo for UPLOAD')}}
                </label>
                <input type="file" id="photo" name="photo" class="block mt-1 w-full" accept="image/*" onchange="previewImage(event)" >

            </div>

            <!-- Image Preview Section -->
            <div class="single-login-field mt-4" style="display: flex; justify-content: center;">

            <img id="image-preview" src="#" alt="Image Preview" style="display: none; width: 200px; height: 200px; object-fit: cover; border: 1px solid #ccc;">
            </div>
            <div class="flex items-center justify-between mt-4">
                <x-button type="button" onclick="location.href='{{route('services.step.select_address')}}';">{{__('Back')}}</x-button>
                <x-button type="submit">{{__('Next')}}</x-button>
            </div>
        </div>
    </form>

    <x-slot name="script">
        <script>
            function previewImage(event) {
                var input = event.target;
                var reader = new FileReader();

                reader.onload = function(){
                    var preview = document.getElementById('image-preview');
                    preview.src = reader.result;
                    preview.style.display = 'block';  // Show the image preview once the file is loaded
                };

                if(input.files && input.files[0]) {
                    reader.readAsDataURL(input.files[0]);  // Read the image file as a data URL
                }

                $('.custom-file-upload').text("{{__('Change Photo')}}");
            }
        </script>
    </x-slot>
</x-service-register-layout>
