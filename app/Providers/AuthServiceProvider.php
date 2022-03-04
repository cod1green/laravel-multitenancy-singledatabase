<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        // Para não da erro no terminal
        if (app()->runningInConsole()) {
            return;
        }

        $this->registerPolicies();

        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            Gate::define(
                $permission->name,
                function (User $user) use ($permission) {
                    return $user->hasPermission($permission->name);
                }
            );
        }

        Gate::before(
            function (User $user) {
                if ($user->isAdmin()) {
                    return true;
                }
            }
        );
    }
}
