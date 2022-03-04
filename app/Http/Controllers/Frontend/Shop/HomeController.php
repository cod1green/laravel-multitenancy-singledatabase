<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function __invoke()
    {
        $products = Product::where('featured', true)->take(8)->inRandomOrder()->get();

        return view('frontend.the_project.shop.pages.home.index', compact('products'));
    }
}
