<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = Product::factory()
            ->count(5)
            ->for(Tenant::first())
            ->create();

        $categories = Category::all();

        $products->each(
            fn($product) => $product->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            )
        );
    }
}
