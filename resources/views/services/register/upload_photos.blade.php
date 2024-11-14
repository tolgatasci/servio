<x-service-register-layout>
    <x-slot name="style">
        <style>
            .progress-bar {
                height: 100%;
                width: 90%;
                background-color: #4CAF50;
                transition: width 0.4s ease;
            }

            /* Custom file input button */
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

            /* Hide the default file input */
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

    <form action="{{ route('services.step.upload_photos.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="wizard-step">
            <h3>{{__('Pictures you have made before, related to your work')}}</h3>
            <x-validation-errors class="errors" />
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Custom File Upload Button -->
            <div class="single-login-field">
                <p class="alert alert-warning">{{__('Use ctrl on the keyboard to select multiple files.')}}</p>
                <label for="photos" class="custom-file-upload">
                    {{__('Select Photos for UPLOAD (Max 10)')}}
                </label>
                <input type="file" id="photos" name="photos[]" class="block mt-1 w-full" accept="image/*" multiple onchange="previewImages(event)">
            </div>

            <!-- Image Preview Section -->
            <div class="preview-images" id="preview-images"></div>

            <div class="flex items-center justify-between mt-4">
                <x-button type="button" onclick="location.href='{{route('services.step.select_address')}}';">{{__('Back')}}</x-button>
                <x-button type="submit">{{__('Next')}}</x-button>
            </div>
        </div>
    </form>

    <x-slot name="script">
        <script>
            function previewImages(event) {
                var input = event.target;
                var previewContainer = document.getElementById('preview-images');
                previewContainer.innerHTML = ""; // Clear previous previews

                // Max 10 images allowed
                if (input.files.length > 10) {
                    alert("{{__('You can only upload a maximum of 10 images.')}}");
                    input.value = ''; // Clear file input
                    return;
                }

                // Loop through the selected files and generate preview for each
                for (let i = 0; i < input.files.length; i++) {
                    let file = input.files[i];
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        let img = document.createElement("img");
                        img.src = e.target.result;
                        previewContainer.appendChild(img); // Add image to preview container
                    }

                    reader.readAsDataURL(file); // Read the image file as a data URL
                }

                // Change the button text after file selection
                document.querySelector('.custom-file-upload').textContent = "{{__('Change Photos')}}";
            }
        </script>
    </x-slot>
</x-service-register-layout>
