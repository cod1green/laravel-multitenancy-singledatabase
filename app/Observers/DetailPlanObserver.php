<?php

namespace App\Observers;

use App\Models\DetailPlan;
use Illuminate\Support\Str;

class DetailPlanObserver
{
    /**
     * Handle the DetailPlan "creating" event.
     *
     * @param  \App\Models\DetailPlan  $detailPlan
     * @return void
     */
    public function creating(DetailPlan $detailPlan)
    {
        $detailPlan->url = Str::slug($detailPlan->name);
    }

    /**
     * Handle the DetailPlan "updating" event.
     *
     * @param  \App\Models\DetailPlan  $detailPlan
     * @return void
     */
    public function updating(DetailPlan $detailPlan)
    {
        $detailPlan->url = Str::slug($detailPlan->name);
    }
}
