<!-- main start -->
<!-- ================ -->
<div class="main col-lg-9">
    <!-- page-title start -->
    <!-- ================ -->
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="page-title">{{ $categoryName }}</h1>
        <div class="ml-auto">
            <span class="text-bold">Ordenar: </span>

            <a href="{{ route('shop.products.index', ['page' => request()->page, 'category' => request()->category, 'sort' => 'asc']) }}"
               class="btn btn-default-transparent">Menor preço</a>

            <a href="{{ route('shop.products.index', ['page' => request()->page, 'category' => request()->category, 'sort' => 'desc']) }}"
               class="btn btn-default">Maior preço</a>
        </div>
    </div>

    <div class="separator-2"></div>
    <!-- page-title end -->

    <!-- page-content start -->
    <!-- ================== -->
    <div class="row">
        <div class="col-md-12">
            <div class="row grid-space-10">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="listing-item white-bg bordered mb-20">
                            <div class="overlay-container">
                                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}">
                                <!-- <span class="badge">25% OFF</span> -->
                                <a class="overlay-link" href="{{ route('shop.products.show', $product->slug) }}">
                                    <i class="fa fa-link"></i>
                                </a>
                                <div class="overlay-to-top links">
                                    <span class="small">
                                      <a href="#" class="btn-sm-link"><i class="fa fa-heart-o pr-10"></i>Adicionar a lista de desejos</a>
                                    </span>
                                </div>
                            </div>
                            <div class="body">
                                <h3>
                                    <a href="{{ route('shop.products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                                <p class="small">{{ $product->details }}</p>
                                <div class="d-flex align-items-center justify-content-between align-items-center">
                                    <!-- <span class="price"><del>$199.00</del> $150.00</span> -->
                                    <span class="price">
                                        <i class="fa fa-tag pr-10"></i>{{ $product->presentPrice() }}
                                    </span>

                                    <div class="ml-auto">
                                        <form action="{{ route('shop.cart.store') }}" method="POST"
                                              class="margin-clear">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="hidden" name="name" value="{{ $product->name }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">

                                            <button type="submit"
                                                    class="btn btn-sm btn-default-transparent btn-animated">
                                                Adicionar <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12 pl-1">Nenhum item encontrado</div>
                @endforelse
            </div>

            <div class="row ">
                <div class="col-md-12 d-flex justify-content-center">
                    {{ $products->appends(request()->input())->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- page-content end -->
</div>
<!-- main end -->
