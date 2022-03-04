<?php

namespace App\Observers;

use App\Models\Provider;
use Illuminate\Support\Str;

class ProviderObserver
{
    /**
     * Handle the Provider "creating" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function creating(Provider $provider)
    {
        $provider->url = Str::slug($provider->name);
        $provider->uuid = Str::uuid();
    }

    /**
     * Handle the Provider "updating" event.
     *
     * @param  \App\Models\Provider  $provider
     * @return void
     */
    public function updating(Provider $provider)
    {
        $provider->url = Str::slug($provider->name);
    }
}
