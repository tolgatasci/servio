<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
            <input id="current_password" type="password"
                   class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                   wire:model="state.current_password" autocomplete="current-password" />
            @if($errors->has('current_password'))
                <div class="invalid-feedback">
                    {{ $errors->first('current_password') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('New Password') }}</label>
            <input id="password" type="password"
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   wire:model="state.password" autocomplete="new-password" />
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password"
                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                   wire:model="state.password_confirmation" autocomplete="new-password" />
            @if($errors->has('password_confirmation'))
                <div class="invalid-feedback">
                    {{ $errors->first('password_confirmation') }}
                </div>
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <button type="submit" class="btn btn-primary">
            {{ __('Save') }}
        </button>
    </x-slot>
</x-form-section>
