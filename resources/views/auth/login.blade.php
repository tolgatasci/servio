<x-guest-layout>
    <x-authentication-card>




        <!-- Login Area Start -->
        <section class="jobguru-login-area section_30">
            <div class="container">

                <div class="row">

                    <div class="col-md-12">
                        <div class="login-box">
                            <div class="login-title">
                                <h3>{{__('Login')}}</h3>
                            </div>
                            @if (session()->has('redirect_from_service'))
                                <div class="alert alert-warning">
                                    {{ __('You must log in to continue.')  }}
                                </div>
                            @endif
                            <x-validation-errors class="errors" />
                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}">

                                @csrf
                                <div class="single-login-field">
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                </div>

                                <div class="single-login-field">
                                    <x-label for="password" value="{{ __('Password') }}" />
                                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                                </div>

                                <label for="remember_me" class="flex items-center">
                                    <x-checkbox id="remember_me" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                                <div class="single-login-field">



                                    <x-button class="ml-4">
                                        {{ __('Log in') }}
                                    </x-button>
                                </div>
                            </form>
                            <div class="mt-5">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-outline-success btn-sm" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                                <a class="btn btn-outline-success btn-sm float-right" href="{{route('register')}}">{{ __('Register') }}</a>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Login Area End -->



    </x-authentication-card>
</x-guest-layout>
