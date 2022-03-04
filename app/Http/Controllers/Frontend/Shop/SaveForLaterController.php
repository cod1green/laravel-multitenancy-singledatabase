<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveForLaterController extends Controller
{

    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return back()->with('success_message', 'Item has been removed.');
    }

    public function switchToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        $duplicate = Cart::instance('default')->search(fn($cartItem, $rowId) => $rowId === $id);
        if ($duplicate->isNotEmpty()) {
            return back()->with('success_message', 'Item is already added for cart');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);

        return back()->with('success_message', 'Item has been moved to cart');
    }
}
