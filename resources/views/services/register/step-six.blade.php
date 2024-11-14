<!-- resources/views/services/step-six.blade.php -->
<x-guest-layout>
    <form action="{{ route('services.step-six.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="wizard-step">
            <h3>Daha Önce Yaptığınız İşlerden Fotoğraf Yükleyin</h3>
            <div class="single-login-field">
                <x-label for="photos" value="Fotoğraflar" />
                <input type="file" id="photos" name="photos[]" multiple class="block mt-1 w-full">
            </div>
            <div class="flex items-center justify-between mt-4">
                <x-button type="button" onclick="window.history.back()">Geri</x-button>
                <x-button type="submit">Kaydet</x-button>
            </div>
        </div>
    </form>
</x-guest-layout>
