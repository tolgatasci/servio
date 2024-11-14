<div class="profile-image-container">
    <label for="profile_image">{{ __('Profile Image') }}</label>
    <div class="image-preview">
        <img src="{{ $profile_image }}" alt="Profile Image" id="profile-image-preview">
    </div>
    <input type="file" id="profile_image" name="serviceRequest[profile_image]" accept="image/*">
</div>

<style>
    .profile-image-container {
        text-align: center;
        margin-top: 15px;
    }
    .image-preview {
        margin-top: 10px;
    }
    #profile-image-preview {
        width: 150px; /* Küçük boyut */
        height: 150px; /* Küçük boyut */
        object-fit: cover; /* Resim kesilmeden ortalanır */
        border: 2px solid #ddd;
        border-radius: 8px; /* Köşeler yuvarlatılır */
    }
</style>
