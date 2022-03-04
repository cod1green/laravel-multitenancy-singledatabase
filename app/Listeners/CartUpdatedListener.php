<?php

namespace App\Listeners;

use App\Jobs\UpdateCoupon;
use App\Models\Coupon;

class CartUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $couponName = session()->get('coupon')['name'] ?? null;
//        dd($couponName);

        if ($couponName) {
            $coupon = Coupon::where('code', $couponName)->first();

            dispatch_sync(new UpdateCoupon($coupon));
        }
    }
}
