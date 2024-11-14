<x-guest-layout>
    <x-authentication-card>

        <section class="jobguru-login-area section_30">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="login-box">
                            <div class="login-title">
                                <h3>{{__('Register')}}</h3>
                            </div>
                            <x-validation-errors class="errors" />

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="single-login-field">
                                    <x-label for="name" value="{{ __('Name') }}" />
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                </div>
                                <div class="single-login-field">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                </div>
                                <div class="single-login-field">
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                </div>
                                <div class="single-login-field">
                                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                                </div>

                                <div class="remember-row single-login-field clearfix">
                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <div class="mt-4">
                                            <x-label for="terms">
                                                <div class="flex items-center">
                                                    <x-checkbox name="terms" id="terms" required />

                                                    <div class="ml-2">
                                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                            </x-label>
                                        </div>
                                    @endif
                                </div>
                                <p class="uyari"></p>
                                <div class="single-login-field">
                                    <button type="submit" id="girisyap">{{ __('Register') }}</button>
                                </div>
                            </form>
                            <div class="mt-4">
                                <a class="btn btn-outline-success btn-sm" href="{{ route('login') }}">  {{ __('Already registered?') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Login Area End -->


    </x-authentication-card>
</x-guest-layout>
