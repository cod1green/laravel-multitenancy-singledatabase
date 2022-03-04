<x-frontend-layout>
    <!-- main-container start -->
    <!-- ================ -->
    <section class="light-gray-bg pv-30 clearfix">
        <div class="container">

            @include('frontend.the_project.shop.includes.alerts')

            <div class="row">
                <!-- main start -->
                <!-- ================ -->
                <div class="main col-12">

                    <!-- page-title start -->
                    <!-- ================ -->
                    <h1 class="page-title">Pedido: {{ $order->id }}</h1>
                    <!-- <div class="separator-2"></div> -->
                    <!-- page-title end -->

                    <!-- page-content start -->
                    <!-- ================== -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-default mb-2">
                                <h5 class="card-header mb-0">
                                    <div class="row">
                                            <div class="col-md-12 pl-0">
                                                <div class="d-flex align-items-center justify-content-between align-items-center">
                                                    <div class="col">
                                                        <div class="font-weight-bold">Pedido realizado</div>
                                                        <div>{{ presentDate($order->created_at) }}</div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-bold">Order ID</div>
                                                        <div>{{ $order->id }}</div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="font-weight-bold">Total</div>
                                                        <div>{{ presentPrice($order->billing_total) }}</div>
                                                    </div>
{{--                                                    <div class="ml-auto">--}}
{{--                                                        <button onclick="location.href='{{ route('shop.orders.show', $order->id) }}'" class="btn btn-sm btn-default-transparent btn-animated">--}}
{{--                                                            Fatura <i class="fas fa-print"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                </h5>

                                <table class="table card-body mb-0">
                                        <tr>
                                            <td class="card-text font-weight-bold col-2">Nome</td>
                                            <td class="col-auto">{{ $order->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="card-text font-weight-bold">Address</td>
                                            <td>{{ $order->billing_address }}</td>
                                        </tr>
                                        <tr>
                                            <td class="card-text font-weight-bold">City</td>
                                            <td>{{ $order->billing_city }}</td>
                                        </tr>
                                        <tr>
                                            <td class="card-text font-weight-bold">Subtotal</td>
                                            <td>{{ presentPrice($order->billing_subtotal) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="card-text font-weight-bold">Tax</td>
                                            <td>{{ presentPrice($order->billing_tax) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="card-text font-weight-bold">Total</td>
                                            <td>{{ presentPrice($order->billing_total) }}</td>
                                        </tr>
                                    </table>
                            </div>

                            <div class="card">
                                <h5 class="card-header">Itens do pedido</h5>
                                <div class="card-body">
                                    @foreach ($order->products as $k => $product)
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="d-flex pr-2">
                                                    <div class="overlay-container">
                                                        <img src="{{ $product->imageUrl() }}" class="media-object"
                                                             alt="{{ $product->name }}">
                                                        <a class="overlay-link"
                                                           href="{{ route('shop.products.show', $product->slug) }}">
                                                            <i class="fa fa-link"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <p>
                                                    <a href="{{ route('shop.products.show', $product->slug) }}">{{ $product->name }}</a>
                                                </p>
                                                <p class="price">{{ $product->details }}</p>
                                                <p class="card-text"><span class="font-weight-bold">Quantidade:</span> {{ $product->pivot->quantity }}</p>
                                                <p class="card-text"><span class="font-weight-bold">Valor:</span> {{ presentPrice($product->pivot->quantity * $product->pivot->price) }}</p>
                                            </div>
                                        </div>

                                        @if (!$loop->last)
                                            <div class="separator-2 mt-3"></div>
                                        @endif

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- page-content end -->

                </div>
                <!-- main end -->

            </div>
        </div>
    </section>
    <!-- main-container end -->
</x-frontend-layout>
