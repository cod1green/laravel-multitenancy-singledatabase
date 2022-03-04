<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
        </x-slot>

        <x-jet-validation-errors class="mb-3"/>

        <div class="card-body">
            <p><strong>{{ __('Plan') }}</strong>: {{ session('plan')->name ?? ''}}</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Document field --}}
                <div class="form-group">
                    <x-jet-label value="{{ __('Document') }}"/>

                    <x-jet-input id="document" name="document"
                                 class="document {{ $errors->has('document') ? 'is-invalid' : '' }}" type="text"
                                 :value="old('document')" required autocomplete="document"
                                 placeholder="{{ __('CPF or CNPJ') }}"/>
                    <x-jet-input-error for="document"></x-jet-input-error>
                </div>

                {{-- Company field --}}
                <div class="form-group">
                    <x-jet-label value="{{ __('Company name') }}"/>

                    <x-jet-input class="{{ $errors->has('company') ? 'is-invalid' : '' }}" type="text" name="company"
                                 :value="old('company')" required autocomplete="company"
                                 placeholder="{{ __('Company name') }}"/>
                    <x-jet-input-error for="company"></x-jet-input-error>
                </div>

                {{-- Name field --}}
                <div class="form-group">
                    <x-jet-label value="{{ __('Complete name') }}"/>

                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" required autocomplete="name"
                                 placeholder="{{ __('Name of responsible') }}"/>
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                {{-- Phone field --}}
                <div class="form-group">
                    <x-jet-label value="{{ __('Phone or Cell phone') }}"/>

                    <x-jet-input class="phone {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" id="phone"
                                 name="phone" :value="old('phone')" required autocomplete="phone"
                                 placeholder="{{ __('Phone or Cell phone') }}"/>
                    <x-jet-input-error for="phone"></x-jet-input-error>
                </div>

                {{-- Email field --}}
                <div class="form-group">
                    <x-jet-label value="{{ __('Email') }}"/>

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" required placeholder="{{ __('Email') }}"/>
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                {{-- Password field --}}
                <div class="form-group">
                    <x-jet-label value="{{ __('Password') }}"/>

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password"
                                 placeholder="{{ __('Password') }}"/>
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                {{-- Confirm password field --}}
                <div class="form-group">
                    <x-jet-label value="{{ __('Confirm Password') }}"/>

                    <x-jet-input class="form-control" type="password" name="password_confirmation" required
                                 autocomplete="new-password" placeholder="{{ __('Confirm Password') }}"/>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="terms" name="terms"/>
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted mr-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-jet-button>
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>

    @push('scripts')
        <script src="{{ mix('vendor/jquery.inputmask/jquery.inputmask.js')}}"></script>

        <script>
            $(function () {
                $(".document").inputmask({
                    mask: ['999.999.999-99', '99.999.999/9999-99'],
                    keepStatic: true
                });

                $(".phone").inputmask({
                    mask: ['(99) 9999-9999', '(99) 99999-9999'],
                    keepStatic: true
                });
            });
        </script>
    @endpush
</x-guest-layout>
