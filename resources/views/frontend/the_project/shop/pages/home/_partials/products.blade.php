<!-- section products start -->
<!-- ================ -->
<section id="shop" class="section light-gray-bg clearfix">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <h2 class="text-center mt-4">Nossos <strong>Produtos</strong></h2>
                <div class="separator"></div>
                <p class="large text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Numquam
                    voluptas facere vero ex tempora saepe perspiciatis ducimus sequi animi.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row grid-space-10">
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-6">
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
                                    <div class="d-flex justify-content-between align-items-center">
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section shop end -->
