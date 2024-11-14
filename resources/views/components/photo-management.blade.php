<div class="photo-management">
    <h4>Existing Photos</h4>
    <div class="existing-photos">
        @php
            $photos = json_decode($serviceRequest->photos, true) ?? [];
        @endphp

        @if (count($photos) > 0)
            @foreach($photos as $index => $photo)
                <div class="photo-wrapper">
                    <img src="{{ $photo }}" alt="Uploaded Photo" width="100" height="100" style="margin: 5px;">
                    <button type="button" class="remove-photo" data-index="{{ $index }}">Delete</button>
                </div>
            @endforeach
        @else
            <p>No existing photos.</p>
        @endif
    </div>
</div>


<!-- Yeni fotoğrafları yükleme bölümü -->
<div class="upload-section">
    <label for="new_photos">Upload New Photos</label>
    <input type="file" name="new_photos[]" accept="image/png, image/jpeg" multiple>
</div>

<!-- Silinecek fotoğrafların indexlerini göndermek için gizli input -->
<script>


    document.addEventListener('turbo:load', function () {
        // Dinamik olarak eklenen '.remove-photo' butonları için 'on' metodu kullanıyoruz
        document.querySelector('.existing-photos').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-photo')) {
                const index = e.target.getAttribute('data-index');

                // Aynı index için input zaten varsa tekrar eklemeyi önlüyoruz
                if (!document.querySelector(`input[name="remove_photos[]"][value="${index}"]`)) {
                    const removePhotosInput = document.createElement('input');
                    removePhotosInput.type = 'hidden';
                    removePhotosInput.name = 'remove_photos[]'; // Silinecek fotoğrafların indexlerini tutuyoruz
                    removePhotosInput.value = index;

                    // Formu doğru bir şekilde seçin ve inputu ekleyin
                    const form = document.querySelector('.photo-management'); // Formu doğru seçtiğinizden emin olun
                    if (form) {
                        form.appendChild(removePhotosInput); // Silinmek istenen resmin indexini forma ekle
                    }
                }

                // Görünümde resmi kaldır
                e.target.closest('.photo-wrapper').remove();
            }
        });
    });





</script>
