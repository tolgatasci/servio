<x-app-layout>

    @php
        $breadcrumbs = [['link' => 'home', 'name' => 'Home'], ['link' => 'javascript:void(0)', 'name' => 'User'], ['name' => 'Profile']];
    @endphp

    <div class="container my-4">

        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Update Profile Information') }}</h5>
                </div>
                <div class="card-body">
                    @livewire('profile.update-profile-information-form')
                </div>
            </div>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Update Password') }}</h5>
                </div>
                <div class="card-body">
                    @livewire('profile.update-password-form')
                </div>
            </div>
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Two Factor Authentication') }}</h5>
                </div>
                <div class="card-body">
                    @livewire('profile.two-factor-authentication-form')
                </div>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <h5>{{ __('Logout Other Browser Sessions') }}</h5>
            </div>
            <div class="card-body">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Delete Account') }}</h5>
                </div>
                <div class="card-body">
                    @livewire('profile.delete-user-form')
                </div>
            </div>
        @endif

    </div>

</x-app-layout>
