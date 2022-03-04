<?php

namespace App\Providers;

use App\Listeners\AddRoleTenant;
use App\Listeners\CartUpdatedListener;
use App\Tenant\Events\TenantCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        TenantCreated::class => [
            AddRoleTenant::class,
        ],

        'cart.added' => [
            CartUpdatedListener::class,
        ],

        'cart.updated' => [
            CartUpdatedListener::class,
        ],

        'cart.removed' => [
            CartUpdatedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
