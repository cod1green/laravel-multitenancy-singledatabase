<?php

namespace App\Observers;

use App\Models\Client;
use Illuminate\Support\Str;

class ClientObserver
{
    /**
     * Handle the Category "creating" event.
     *
     * @param  \App\Models\Client  $category
     * @return void
     */
    public function creating(Client $client)
    {
        $client->uuid = Str::uuid();
        $client->password = bcrypt($client->password);
    }

    /**
     * Handle the Plan "updating" event.
     *
     * @param  \App\Models\Plan  $plan
     * @return void
     */
    public function updating(Client $client)
    {
        $client->password = bcrypt($client->password);
    }
}
