<x-action-section>
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using two factor authentication.') }}
    </x-slot>

    <x-slot name="content">
        <h6>
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('You are enabling two factor authentication.') }}
                @else
                    {{ __('You have enabled two factor authentication.') }}
                @endif
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h6>

        <p class="card-text">
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </p>

        @if ($this->enabled)
            @if ($showingQrCode)
                <p class="card-text mt-2">
                    @if ($showingConfirmation)
                        {{ __('Scan the following QR code using your phone\'s authenticator application and confirm it with the generated OTP code.') }}
                    @else
                        {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                    @endif
                </p>

                <div class="mt-2">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4">
                    <p class="fw-medium">
                        {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-2">
                        <label for="code" class="form-label">{{ __('Code') }}</label>
                        <input id="code" class="form-control mt-3 w-100" type="text" inputmode="numeric" name="code" autofocus autocomplete="one-time-code"
                               wire:model="code" wire:keydown.enter="confirmTwoFactorAuthentication" />
                        @error('code')
                        <div class="invalid-feedback mt-3">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <p class="card-text mt-2">
                    {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                </p>

                <div class="bg-light rounded p-2">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-2">
            @if (!$this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <button type="button" class="btn btn-primary" wire:loading.attr="disabled">
                        {{ __('Enable') }}
                    </button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <button type="button" class="btn btn-secondary me-1" wire:loading.attr="disabled">
                            {{ __('Regenerate Recovery Codes') }}
                        </button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <button type="button" class="btn btn-primary" wire:loading.attr="disabled">
                            {{ __('Confirm') }}
                        </button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <button type="button" class="btn btn-secondary me-1" wire:loading.attr="disabled">
                            {{ __('Show Recovery Codes') }}
                        </button>
                    </x-confirms-password>
                @endif

                <x-confirms-password wire:then="disableTwoFactorAuthentication">
                    <button type="button" class="btn btn-danger" wire:loading.attr="disabled">
                        {{ __('Disable') }}
                    </button>
                </x-confirms-password>
            @endif
        </div>
    </x-slot>
</x-action-section>
