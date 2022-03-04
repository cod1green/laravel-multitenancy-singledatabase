<x-frontend-layout>
    <!-- section start -->
    <!-- ================ -->
    <section id="class" class="light-gray-bg py-2 clearfix">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8 col-lg-12 my-4">
                <div class="card border-0">
                    <div class="card-body">
                        <x-jet-validation-errors class="mb-3 rounded-0" />

                        @if (session('status'))
                            <div class="alert alert-success mb-3 rounded-0" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col pr-5">
                                <div class="card-body">
                                    <h2 class="card-title font-weight-bold">Login</h2>

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <x-jet-label value="{{ __('Email') }}" />

                                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                                         name="email" :value="old('email')" required />
                                            <x-jet-input-error for="email"></x-jet-input-error>
                                        </div>

                                        <div class="form-group">
                                            <x-jet-label value="{{ __('Password') }}" />

                                            <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                                         name="password" required autocomplete="current-password" />
                                            <x-jet-input-error for="password"></x-jet-input-error>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <x-jet-checkbox id="remember_me" name="remember"/>
                                                <label class="custom-control-label" for="remember_me">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mb-0">
                                            <div class="d-flex justify-content-start align-items-baseline">
                                                <x-jet-button class="mr-3">
                                                    {{ __('Log in') }}
                                                </x-jet-button>

                                                @if (Route::has('password.request'))
                                                    <a class="text-muted" href="{{ route('password.request') }}">
                                                        {{ __('Forgot your password?') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col border-left pl-5">
                                <div class="card-body">
                                    <h2 class="card-title font-weight-bold">{{ __('New Customer') }}</h2>
                                    <h5 class="font-weight-bold">{{ __('Save time now.') }}</h5>
                                    <p class="card-text">{{ __('You don\'t need an account to checkout.') }}</p>
                                    <a class="btn btn-outline-dark" href="{{ route('shop.guestCheckout.index') }}">
                                        {{ __('Continue as Guest') }}
                                    </a>
                                </div>

                                <div class="card-body">
                                    <h5 class="font-weight-bold">{{ __('Save time later.') }}</h5>
                                    <p class="card-text">{{ __('Create an account for fast checkout and easy access to order history.') }}</p>
                                    <a class="btn btn-outline-dark" href="{{ route('register') }}">
                                        {{ __('Create Account') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- section end -->
</x-frontend-layout>
