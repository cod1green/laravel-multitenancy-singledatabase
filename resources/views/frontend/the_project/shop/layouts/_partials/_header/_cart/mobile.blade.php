<div class="btn-group">
    <button type="button" class="btn dropdown-toggle dropdown-toggle--no-caret"
            id="header-drop-4" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
        <i class="fa fa-shopping-cart fa-lg"></i>
        @if(Cart::instance('default')->count() > 0)
            <span
                class="cart-count default-bg">{{ Cart::instance('default')->count() }}</span>
        @endif
    </button>
    <ul class="dropdown-menu dropdown-menu-right cart dropdown-animation"
        aria-labelledby="header-drop-4">
        <li>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="quantity">QTD</th>
                    <th class="product">Produto</th>
                    <th class="amount">Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @forelse(Cart::instance('default')->content() as $item)
                    <tr>
                        <td class="quantity">{{ $item->qty }} x</td>
                        <td class="product">
                            <a href="{{ route('shop.products.show', $item->model->slug) }}">
                                {{ $item->model->name }}
                            </a>
                            <span class="small">{{ $item->model->details }}</span>
                        </td>
                        <td class="amount">{{ presentPrice($item->qty * $item->model->price) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Não há itens</td>
                    </tr>
                @endforelse
                @if(Cart::instance('default')->count() > 0)
                    <tr>
                        <td class="total-quantity" colspan="2">
                            Total {{ Cart::instance('default')->count() }} Items
                        </td>
                        <td class="total-amount">
                            R${{ Cart::instance('default')->subtotal() }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
            <div class="panel-body text-right">
                <a href="{{ route('shop.cart.index') }}"
                   class="btn btn-group btn-sm btn-default-transparent btn-animated">
                    Ver carrinho <i class="fa fa-shopping-cart"></i>
                </a>
                @if(Cart::instance('default')->count() > 0)
                    <a href="{{ route('shop.checkout.index') }}"
                       class="btn btn-group btn-sm btn-default btn-animated">
                        Checkout<i class="fas fa-credit-card"></i>
                    </a>
                @endif
            </div>
        </li>
    </ul>
</div>
