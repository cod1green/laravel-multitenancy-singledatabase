<!-- section start -->
<!-- ================ -->
<section class="light-gray-bg pv-30 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="block clearfix">
                    <h3 class="title">Você pode gostar</h3>
                    @foreach($mightAlsoLike as $product)
                        <div class="separator-2"></div>
                        <div class="media margin-clear">
                            <div class="d-flex pr-2">
                                <div class="overlay-container">
                                    <img src="{{ $product->imageUrl() }}" class="media-object"
                                         alt="{{ $product->name }}">
                                    <a class="overlay-link small"
                                       href="{{ route('shop.products.show', $product->slug) }}">
                                        <i class="fa fa-link"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">
                                    <a href="{{ route('shop.products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h6>
                                <!-- <p class="margin-clear">
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                </p> -->
                                <p class="price">{{ $product->presentPrice() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div class="block clearfix">
                    <h3 class="title">Mais vendidos</h3>
                    <div class="separator-2"></div>
                    @foreach($bestSellers as $product)
                        <div class="separator-2"></div>
                        <div class="media margin-clear">
                            <div class="d-flex pr-2">
                                <div class="overlay-container">
                                    <img src="{{ $product->imageUrl() }}" class="media-object"
                                         alt="{{ $product->name }}">
                                    <a class="overlay-link small"
                                       href="{{ route('shop.products.show', $product->slug) }}">
                                        <i class="fa fa-link"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">
                                    <a href="{{ route('shop.products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h6>
                                <!-- <p class="margin-clear">
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                </p> -->
                                <p class="price">{{ $product->presentPrice() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div class="block clearfix">
                    <h3 class="title">Mais votado</h3>
                    @foreach($topRated as $product)
                        <div class="separator-2"></div>
                        <div class="media margin-clear">
                            <div class="d-flex pr-2">
                                <div class="overlay-container">
                                    <img src="{{ $product->imageUrl() }}" class="media-object"
                                         alt="{{ $product->name }}">
                                    <a class="overlay-link small"
                                       href="{{ route('shop.products.show', $product->slug) }}">
                                        <i class="fa fa-link"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">
                                    <a href="{{ route('shop.products.show', $product->slug) }}">{{ $product->name }}</a>
                                </h6>
                                <!-- <p class="margin-clear">
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                    <i class="fa fa-star text-default"></i>
                                </p> -->
                                <p class="price">{{ $product->presentPrice() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- section end -->
