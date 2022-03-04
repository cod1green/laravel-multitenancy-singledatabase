<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    /**
     * Handle the Product "creating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        $product->uuid = Str::uuid();
        $product->slug = Str::slug($product->name);

        $product->price = str_replace(array('.', ','), array('', '.'), $product->price);
    }

    /**
     * Handle the Product "updating" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        $product->slug = Str::slug($product->name);

        $product->price = str_replace(array('.', ','), array('', '.'), $product->price);
    }
}
