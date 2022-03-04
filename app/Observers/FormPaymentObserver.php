<?php

namespace App\Observers;

use App\Models\FormPayment;
use Illuminate\Support\Str;

class FormPaymentObserver
{
    /**
     * Handle the FormPayment "creating" event.
     *
     * @param  \App\Models\FormPayment  $formPayment
     * @return void
     */
    public function creating(FormPayment $formPayment)
    {
        $formPayment->uuid = Str::uuid();
        $formPayment->slug = Str::slug($formPayment->name);
    }

    /**
     * Handle the FormPayment "updating" event.
     *
     * @param  \App\Models\FormPayment  $formPayment
     * @return void
     */
    public function updating(FormPayment $formPayment)
    {
        $formPayment->slug = Str::slug($formPayment->name);
    }
}
