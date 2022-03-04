<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        return view(
            'frontend.the_project.shop.pages.cart.index',
        )->with(
            [
                'mightAlsoLike' => Product::mightAlsoLike()->get(),
                'bestSellers' => Product::mightAlsoLike()->get(),
                'topRated' => Product::mightAlsoLike()->get(),
                'discount' => cart()->get('discount'),
                'newSubtotal' => cart()->get('newSubtotal'),
                'newTax' => cart()->get('newTax'),
                'newTotal' => cart()->get('newTotal')
            ]
        );
    }

    public function store(Request $request)
    {
        Cart::add($request->id, $request->name, 1, $request->price)->associate(Product::class);

        return back()->with('success_message', 'Item wa added to your cart');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'quantity' => 'required|numeric|between:1,5'
            ]
        );

        if ($validator->fails()) {
            session()->flash('errors', Collect(['A quantidade deve estar entre 1 e 5.']));
            return response()->json(['success' => false], 400);
        }

        if ($request->quantity > $request->productQuantity) {
            session()->flash('errors', Collect(['No momento não temos itens suficientes em estoque.']));
            return response()->json(['success' => false], 400);
        }

        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'A quantidade foi atualizada com sucesso');
        return response()->json(['success' => true]);
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);

        if (Cart::instance('default')->count() === 0) {
            session()->forget('coupon');
        }

        return back()->with('success_message', 'O item foi removido.');
    }

    public function switchToSaveForLater($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $duplicate = Cart::instance('saveForLater')->search(fn($cartItem, $rowId) => $rowId === $id);
        if ($duplicate->isNotEmpty()) {
            return back()->with('success_message', 'Item is already saved for later');
        }

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)->associate(Product::class);

        return back()->with('success_message', 'Item has been saved for Later');
    }
}
