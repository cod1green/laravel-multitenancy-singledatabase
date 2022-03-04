<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div>
                @livewire('profile.update-profile-information-form')
            </div>

            <x-jet-section-border/>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div>
                @livewire('profile.update-password-form')
            </div>

            <x-jet-section-border/>
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div>
                @livewire('profile.two-factor-authentication-form')
            </div>

            <x-jet-section-border/>
        @endif

        <div>
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <x-jet-section-border/>

                <div>
                    @livewire('profile.delete-user-form')
                </div>
            @endif
    </div>
</x-app-layout>
