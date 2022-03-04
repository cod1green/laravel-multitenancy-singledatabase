<?php

namespace App\Http\Controllers\Frontend\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\CheckoutRequest;
use App\Mail\OrderPlaced;
use App\Models\{Order, Product};
use App\Services\Order\OrderCreator;
use App\Tenant\ManagerTenant;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    private OrderCreator $orderCreator;

    public function __construct(OrderCreator $orderCreator)
    {
        $this->orderCreator = $orderCreator;
    }

    public function index()
    {
        if (Cart::instance('default')->count() === 0) {
            return redirect()->route('shop.products.index');
        }

        if (auth()->user() && request()->is('guest-checkout')) {
            return redirect()->route('shop.checkout.index');
        }

        return view('frontend.the_project.shop.pages.checkout.index')
            ->with(
                [
                    'discount' => cart()->get('discount'),
                    'newSubtotal' => cart()->get('newSubtotal'),
                    'newTax' => cart()->get('newTax'),
                    'newTotal' => cart()->get('newTotal')
                ]
            );
    }

    public function store(CheckoutRequest $request)
    {
        // Verifica se os produtos não estão mais disponíveis
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Sorry! One of the items in your cart is no longer avialble.');
        }

        try {
            $charge = Stripe::charges()->create(
                [
                    'amount' => cart()->get('newTotal'),
                    'currency' => config('cashier.currency'),
                    'source' => $request->stripeToken,
                    'description' => 'Order',
                    'receipt_email' => $request->email,
                    'metadata' => [
                        'contents' => cartProductsToJson(),
                        'quantity' => Cart::instance('default')->count(),
                        'discount' => collect(session()->get('coupon'))->toJson(),
                    ],
                ]
            );

            $order = $this->addOrderToTable($request);
            Mail::send(new OrderPlaced($order));

            $this->decreaseQuantities();

            Cart::instance('default')->destroy();
            session()->forget('coupon');

            return redirect()->route('shop.confirmation.index')->with(
                'success_message',
                'Seu pagamento foi aceito com sucesso!'
            );
        } catch (CardErrorException $e) {
            $this->addOrderToTable($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    private function productsAreNoLongerAvailable()
    {
        foreach (Cart::instance('default')->content() as $item) {
            $product = Product::find($item->model->id);
            if ($product->quantity < $item->qty) {
                return true;
            }
        }

        return false;
    }

    private function addOrderToTable($request, $error = null): Order
    {
        $data = [
            'tenant_id' => app(ManagerTenant::class)->getTenantIdentify(),
            'user_id' => auth()->user()->id ?? null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => cart()->get('discount'),
            'billing_discount_code' => cart()->get('code'),
            'billing_subtotal' => cart()->get('newSubtotal'),
            'billing_tax' => cart()->get('newTax'),
            'billing_total' => cart()->get('newTotal'),
            'products' => cart()->get('products'),
            'error' => $error,
        ];

        return $this->orderCreator->create($data);
    }

    private function decreaseQuantities()
    {
        foreach (Cart::instance('default')->content() as $item) {
            $product = Product::find($item->model->id);

            $product->update(['quantity' => $product->quantity - $item->qty]);
        }
    }
}
