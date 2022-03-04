<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('products')->latest()->paginate();

        return view('frontend.the_project.shop.pages.orders.index')
            ->with(compact('orders'));
    }

    public function show(Order $order)
    {
        if (auth()->id() !== $order->user_id) {
            return back()->withErrors('Você não tem acesso a isso!');
        }

        $products = $order->products;

        return view('frontend.the_project.shop.pages.orders.show')->with(compact('order','products'));
    }
}

