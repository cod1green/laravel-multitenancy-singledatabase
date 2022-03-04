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
                    <h1 class="page-title">Meus pedidos</h1>
                    <!-- <div class="separator-2"></div> -->
                    <!-- page-title end -->

                    <!-- page-content start -->
                    <!-- ================== -->
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($orders as $key => $order)
                                <div class="accordion collapse-contextual" id="accordion">
                                    <div class="card card-default mb-2">
                                        <div class="card-header" id="heading-{{ $key }}">
                                            <h4 class="mb-0">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $key }}" aria-controls="collapse-{{ $key }}">
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
                                                                <div class="ml-auto">
                                                                    <button onclick="location.href='{{ route('shop.orders.show', $order->id) }}'" class="btn btn-sm btn-default-transparent btn-animated">
                                                                        Detalhes <i class="fa fa-file-alt"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </h4>
                                        </div>

                                        <div id="collapse-{{ $key }}" class="collapse {{ $key === 0 ? 'show' : '' }}" aria-labelledby="heading-{{ $key }}" data-parent="#accordion">
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
                                                            <p class="text-dark"><span class="font-weight-bold">Quantidade:</span> {{ $product->pivot->quantity }}</p>
                                                            <p class="text-dark"><span class="font-weight-bold">Valor:</span> {{ presentPrice($product->pivot->quantity * $product->pivot->price) }}</p>
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
                            @endforeach
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
