<?php

namespace App\Actions\Fortify;

use App\Services\TenantService;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        if (!$plan = session('plan')) {
            return redirect()->route('site.home');
        }

        Validator::make(
            $input,
            [
                'document' => ['required', 'string', 'max:255'],
                'company' => ['required', 'string', 'min:3', 'max:255'],
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:14', 'max:15'],
                'email' => ['required', 'string', 'email', 'min:3', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ]
        )->validate();

        return app(TenantService::class)->make($plan, $input);
    }
}
