<?php

namespace App\Observers;

use App\Models\Coupon;
use Illuminate\Support\Str;

class CouponObserver
{
    /**
     * Handle the Coupon "creating" event.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return void
     */
    public function creating(Coupon $coupon)
    {
        $coupon->uuid = Str::uuid();
        $coupon->slug = Str::slug($coupon->code);
    }

    /**
     * Handle the Coupon "updating" event.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return void
     */
    public function updating(Coupon $coupon)
    {
        $coupon->slug = Str::slug($coupon->code);
    }

    /**
     * Handle the Coupon "deleted" event.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return void
     */
    public function deleted(Coupon $coupon)
    {
        //
    }

    /**
     * Handle the Coupon "restored" event.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return void
     */
    public function restored(Coupon $coupon)
    {
        //
    }

    /**
     * Handle the Coupon "force deleted" event.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return void
     */
    public function forceDeleted(Coupon $coupon)
    {
        //
    }
}
