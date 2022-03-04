<x-frontend-layout>
    <!-- main-container start -->
    <!-- ================ -->
    <section class="light-gray-bg py-2 clearfix">
        <div class="container">

            @include('frontend.the_project.shop.includes.alerts')

            <div class="row">
                <!-- main start -->
                <!-- ================ -->
                <div class="main col-12">

                    <!-- page-title start -->
                    <!-- ================ -->
                    <h1 class="page-title">Carrinho de Compras</h1>
                    <!-- <div class="separator-2"></div> -->
                    <!-- page-title end -->

                    <table class="table cart table-hover table-colored">
                        <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Ações</th>
                            <th class="amount">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(Cart::instance('default')->count() > 0)
                            @foreach(Cart::instance('default')->content() as $item)
                                <tr class="remove-data">
                                    <td class="product">
                                        <div class="block clearfix mb-0">
                                            <div class="media margin-clear">
                                                <div class="d-flex pr-2">
                                                    <div class="overlay-container">
                                                        <img class="media-object" src="{{ $item->model->imageUrl() }}"
                                                             alt="{{ $item->model->name }}">
                                                        <a class="overlay-link small"
                                                           href="{{ route('shop.products.show', $item->model->slug) }}">
                                                            <i class="fa fa-link"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <a href="{{ route('shop.products.show', $item->model->slug) }}">{{ $item->model->name }}</a>
                                                    <small>{{ $item->model->details }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price">{{ $item->model->presentPrice() }}</td>
                                    <td class="quantity">
                                        <div class="form-group">
                                            <select class="qty form-control" data-id="{{ $item->rowId }}"
                                                    data-product-quantity="{{ $item->model->quantity }}">
                                                @for ($i = 1; $i < 5 + 1 ; $i++)
                                                    <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </td>
                                    <td class="w-27">
                                        <div class="d-flex align-items-center">
                                            <form class="m-0" action="{{ route('shop.cart.destroy', $item->rowId) }}"
                                                  method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-default btn-animated mr-1">
                                                    Remover <i class="fa fa-trash"></i>
                                                </button>
                                            </form>

                                            <form class="m-0"
                                                  action="{{ route('shop.cart.switchToSaveForLater', $item->rowId) }}"
                                                  method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-default-transparent btn-animated"
                                                        type="submit">
                                                    Salvar para depois <i class="fa fa-save"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="amount">{{ presentPrice($item->subtotal) }}</td>
                                </tr>
                            @endforeach

                            @if(!session()->has('coupon'))
                                <tr>
                                    <td colspan="2">Cupom de desconto</td>
                                    <td colspan="5">
                                        <form method="POST" action="{{ route('shop.coupon.store') }}"
                                              class="form-inline d-flex justify-content-end">
                                            @csrf
                                            <div class="input-group">
                                                <input id="coupon_code" name="coupon_code" type="text"
                                                       class="form-control"
                                                       placeholder="Código do cupom">
                                                <div class="input-group-append">
                                                    <button class="btn btn-dark" type="submit">Aplicar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td colspan="4">Subtotal</td>
                                <td class="total-amount font-weight-normal">
                                    {{ presentPrice(Cart::instance('default')->subtotal()) }}
                                </td>
                            </tr>

                            @if(session()->has('coupon'))
                                <tr>
                                    <td colspan="3">
                                        {{--                                        <div class="col-auto">--}}
                                        <div class="d-flex align-items-center">
                                                <span class="text-success mr-1">
                                                    Desconto ({{ session()->get('coupon')['name'] }})
                                                </span>
                                            {{--                                            <div class="ml-auto">--}}
                                            <form action="{{ route('shop.coupon.destroy', 1) }}" method="POST"
                                                  class="margin-clear">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-default-transparent">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                            {{--                                            </div>--}}
                                        </div>
                                        {{--                                        </div>--}}
                                    </td>
                                    <td colspan="2" class="total-amount font-weight-normal pr-0">
                                        <div class="col d-flex align-items-center justify-content-end">
                                            <span class="text-success">
                                                - {{ presentPrice($discount) }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Novo Subtotal</td>
                                    <td class="total-amount font-weight-normal">
                                        {{ presentPrice($newSubtotal) }}
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td colspan="4">Taxa ({{ config('cart.tax') }}%)</td>
                                <td class="total-amount font-weight-normal">
                                    {{ presentPrice($newTax) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="total-quantity" colspan="4">
                                    Total {{ Cart::instance('default')->count() }} Itens
                                </td>
                                <td class="total-amount">
                                    {{ presentPrice($newTotal) }}
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="4">Não há itens</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    @if(Cart::count() > 0)
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="btn btn-group btn-default-transparent btn-animated"
                               href="{{ route('shop.products.index') }}">
                                Continue comprando <i class="fas fa-store"></i>
                            </a>
                            <div class="ml-auto">
                                <a class="btn btn-group btn-default btn-animated"
                                   href="{{ route('shop.checkout.index') }}">
                                    Finalizar Compra<i class="fas fa-credit-card"></i>
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
                <!-- main end -->

            </div>
        </div>
    </section>
    <!-- main-container end -->

@if(Cart::instance('saveForLater')->count() > 0)
    <!-- save for later section start -->
        <!-- ============================ -->
        <section class="pv-30 clearfix">

            <div class="container">
                <div class="row">

                    <!-- main start -->
                    <!-- ================ -->
                    <div class="main col-12">

                        <!-- page-title start -->
                        <!-- ================ -->
                        <h1 class="page-title">Salvo para depois</h1>
                        <div class="separator-2"></div>
                        <!-- page-title end -->

                        <table class="table cart table-hover table-dark">
                            <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Preço</th>
                                <th>Ações</th>
                                <th class="amount">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Cart::instance('saveForLater')->content() as $item)
                                <tr class="remove-data">
                                    <td class="product">
                                        <div class="block clearfix mb-0">
                                            <div class="media margin-clear">
                                                <div class="d-flex pr-2">
                                                    <div class="overlay-container">
                                                        <img class="media-object" src="{{ $item->model->imageUrl() }}"
                                                             alt="{{ $item->model->name }}">
                                                        <a class="overlay-link small"
                                                           href="{{ route('shop.products.show', $item->model->slug) }}">
                                                            <i class="fa fa-link"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <a href="{{ route('shop.products.show', $item->model->slug) }}">{{ $item->model->name }}</a>
                                                    <small>{{ $item->model->details }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="price">{{ $item->model->presentPrice() }}</td>
                                    <td class="w-27">
                                        <div class="d-flex align-items-center">
                                            <form class="m-0"
                                                  action="{{ route('shop.saveForLater.destroy', $item->rowId) }}"
                                                  method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-default btn-animated mr-1">
                                                    Remover <i class="fa fa-trash"></i>
                                                </button>
                                            </form>

                                            <form class="m-0"
                                                  action="{{ route('shop.saveForLater.switchToCart', $item->rowId) }}"
                                                  method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-default-transparent btn-animated">
                                                    Mover para carrinho <i class="fa fa-shopping-cart"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="amount">{{ presentPrice($item->qty * $item->model->price) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- main end -->

                </div>
            </div>
        </section>
        <!-- save for later section end -->
    @endif

    @include('frontend.the_project.shop.pages.cart.partials.might-like', compact('mightAlsoLike', 'bestSellers', 'topRated'))

    @push('styles')
        <style>
            .w-27 {
                width: 27%;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            (function () {
                const classname = document.querySelectorAll('.qty');

                Array.from(classname).forEach(function (element) {
                    element.addEventListener('change', function () {
                        const id = element.getAttribute('data-id');
                        const productQuantity = element.getAttribute('data-product-quantity');

                        axios.patch(`cart/${id}`, {
                            quantity: this.value,
                            productQuantity: productQuantity
                        }).then(function (response) {
                            window.location.href = '{{ route('shop.cart.index') }}'
                        }).catch(function (error) {
                            window.location.href = '{{ route('shop.cart.index') }}'
                        })
                    });
                });
            })();
        </script>
    @endpush
</x-frontend-layout>
