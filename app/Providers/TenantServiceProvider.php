<?php

namespace App\Providers;

use App\Models\Tenant;
use App\Tenant\Services\TenantManager;
use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $manager = new TenantManager;

        $this->app->instance(TenantManager::class, $manager);
        $this->app->bind(Tenant::class, function () use ($manager) {
            return $manager->getTenant();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
