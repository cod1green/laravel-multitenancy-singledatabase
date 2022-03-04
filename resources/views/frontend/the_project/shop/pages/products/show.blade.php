@section('title', $product->name)

<x-frontend-layout>
    <!-- main-container start -->
    <!-- ================ -->
    <section class="pv-30 clearfix">
        <div class="container">

            @include('frontend.the_project.shop.includes.alerts')

            <div class="row">
                <!-- main start -->
                <!-- ================ -->
                <div class="main col-12">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="hc-shadow bordered">
                                <div class="overlay-container">
                                    <img alt="" src="{{ $product->imageUrl() }}">
                                    <a class="overlay-link popup-img" href="{{ $product->imageUrl() }}"
                                       title="{{ $product->name }}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="space-bottom"></div>
                            <div class="row grid-space-20">
                                <div class="col-3 mb-2">
                                    <div class="overlay-container">
                                        <img alt="" src="{{ asset('frontend/template/images/portfolio-1.jpg') }}">
                                        <a class="overlay-link small popup-img"
                                           href="{{ asset('frontend/template/images/portfolio-1.jpg') }}"
                                           title="Second image title">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="overlay-container">
                                        <img alt="" src="{{ asset('frontend/template/images/portfolio-3.jpg') }}">
                                        <a class="overlay-link small popup-img"
                                           href="{{ asset('frontend/template/images/portfolio-3.jpg') }}"
                                           title="Third image title">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="overlay-container">
                                        <img alt="" src="{{ asset('frontend/template/images/portfolio-4.jpg') }}">
                                        <a class="overlay-link small popup-img"
                                           href="{{ asset('frontend/template/images/portfolio-4.jpg') }}"
                                           title="Fourth image title">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="overlay-container">
                                        <img alt="" src="{{ asset('frontend/template/images/portfolio-5.jpg') }}">
                                        <a class="overlay-link small popup-img"
                                           href="{{ asset('frontend/template/images/portfolio-5.jpg') }}"
                                           title="Fifth image title">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <h1 class="page-title">{{ $product->name }}</h1>
                            <p>{{ $product->details }}</p>
                            <p>{!! $stockLevel !!}</p>

                            <!-- <div class="clearfix mb-20">
                                <span>
                                  <i class="fa fa-star text-default"></i>
                                  <i class="fa fa-star text-default"></i>
                                  <i class="fa fa-star text-default"></i>
                                  <i class="fa fa-star text-default"></i>
                                  <i class="fa fa-star"></i>
                                </span>
                                <a class="wishlist" href="#"><i class="fa fa-heart-o pl-10 pr-1"></i>Wishlist</a>
                                <ul class="pl-20 pull-right social-links circle small clearfix margin-clear animated-effect-1">
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="googleplus"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                </ul>
                            </div> -->

                            <!-- <form class="clearfix row grid-space-10">
                                    <div class="form-group col-lg-4">
                                        <label>Quantity</label>
                                        <input class="form-control" type="text" value="1">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Color</label>
                                        <select class="form-control">
                                            <option>Red</option>
                                            <option>White</option>
                                            <option>Black</option>
                                            <option>Blue</option>
                                            <option>Orange</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label>Size</label>
                                        <select class="form-control">
                                            <option>5.3"</option>
                                            <option>5.7"</option>
                                        </select>
                                    </div>
                                </form> -->

                            @if($product->quantity > 0)
                                <hr class="mb-10">

                                <div class="d-flex align-items-center light-gray-bg p-20 bordered">
                                    <span class="product price"><i class="fa fa-tag pr-10"></i>{{ $product->presentPrice() }}</span>
                                    <div class="ml-auto">
                                        <form action="{{ route('shop.cart.store') }}" method="POST"
                                              class="margin-clear">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $product->id }}">
                                            <input type="hidden" name="name" value="{{ $product->name }}">
                                            <input type="hidden" name="price" value="{{ $product->price }}">

                                            <button type="submit" class="btn btn-default btn-animated">
                                                Adicionar <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- main end -->

            </div>
        </div>
    </section>
    <!-- main-container end -->

    <!-- Specifications section start -->
    <!-- ================ -->
    <section class="light-gray-bg pv-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs style-4" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#h2tab2" role="tab"><i
                                    class="fa fa-files-o pr-1"></i>Especificações</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#h2tab3" role="tab"><i
                                    class="fa fa-star pr-1"></i>(3) Reviews</a></li> -->
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content padding-top-clear padding-bottom-clear">
                        <div id="h2tab2" class="tab-pane active">
                            <div class="row">
                                <dt class="col-sm-3 text-sm-right">Consectetur</dt>
                                <dd class="col-sm-9">{{ $product->description }}</dd>
                            </div>
                            <hr>
                        </div>
                        <div id="h2tab3" class="tab-pane">
                            <!-- comments start -->
                            <div class="comments margin-clear space-top">
                                <!-- comment start -->
                                <div class="comment clearfix">
                                    <div class="comment-avatar">
                                        <img alt="avatar" class="rounded-circle" src="{{ asset('frontend/template/images/avatar.jpg') }}">
                                    </div>
                                    <header>
                                        <h3>Amazing!</h3>
                                        <div class="comment-meta"><i class="fa fa-star text-default"></i> <i
                                                class="fa fa-star text-default"></i> <i class="fa fa-star text-default"></i>
                                            <i
                                                class="fa fa-star text-default"></i> <i class="fa fa-star"></i> | Today,
                                            12:31
                                        </div>
                                    </header>
                                    <div class="comment-content">
                                        <div class="comment-body clearfix">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                                commodo </p>
                                            <a class="btn-sm-link link-dark pull-right" href="blog-post.html"><i
                                                    class="fa fa-reply"></i> Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- comment end -->

                                <!-- comment start -->
                                <div class="comment clearfix">
                                    <div class="comment-avatar">
                                        <img alt="avatar" class="rounded-circle" src="{{ asset('frontend/template/images/avatar.jpg') }}">
                                    </div>
                                    <header>
                                        <h3>Really Nice!</h3>
                                        <div class="comment-meta"> <i class="fa fa-star text-default"></i> <i class="fa fa-star text-default"></i> <i class="fa fa-star text-default"></i> <i class="fa fa-star text-default"></i> <i class="fa fa-star"></i> | Today, 10:31</div>
                                    </header>
                                    <div class="comment-content">
                                        <div class="comment-body clearfix">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                                exercitation ullamco laboris nisi ut aliquip ex ea commodo </p>
                                            <a class="btn-sm-link link-dark pull-right" href="blog-post.html"><i
                                                    class="fa fa-reply"></i> Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- comment end -->

                                <!-- comment start -->
                                <div class="comment clearfix">
                                    <div class="comment-avatar">
                                        <img alt="avatar" class="rounded-circle" src="{{ asset('frontend/template/images/avatar.jpg') }}">
                                    </div>
                                    <header>
                                        <h3>Worth to Buy!</h3>
                                        <div class="comment-meta"> <i class="fa fa-star text-default"></i> <i class="fa fa-star text-default"></i> <i class="fa fa-star text-default"></i> <i class="fa fa-star text-default"></i> <i class="fa fa-star"></i> | Today, 09:31</div>
                                    </header>
                                    <div class="comment-content">
                                        <div class="comment-body clearfix">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                                exercitation ullamco laboris nisi ut aliquip ex ea commodo </p>
                                            <a class="btn-sm-link link-dark pull-right" href="blog-post.html"><i
                                                    class="fa fa-reply"></i> Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- comment end -->
                            </div>
                            <!-- comments end -->

                            <!-- comments form start -->
                            <div class="comments-form">
                                <h2 class="title">Add your Review</h2>
                                <form>
                                    <div class="form-group has-feedback">
                                        <label for="name4">Name</label>
                                        <input id="name4" class="form-control" placeholder="" required type="text">
                                        <i class="fa fa-user form-control-feedback"></i>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="subject4">Subject</label>
                                        <input id="subject4" class="form-control" placeholder="" required type="text">
                                        <i class="fa fa-pencil form-control-feedback"></i>
                                    </div>
                                    <div class="form-group">
                                        <label>Rating</label>
                                        <select id="review" class="form-control">
                                            <option value="five">5</option>
                                            <option value="four">4</option>
                                            <option value="three">3</option>
                                            <option value="two">2</option>
                                            <option value="one">1</option>
                                        </select>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="message4">Message</label>
                                        <textarea id="message4" class="form-control" placeholder="" required rows="8"></textarea>
                                        <i class="fa fa-envelope-o form-control-feedback"></i>
                                    </div>
                                    <input class="btn btn-default" type="submit" value="Submit">
                                </form>
                            </div>
                            <!-- comments form end -->
                        </div>
                    </div>
                </div>

                <!-- sidebar start -->
                <!-- ================ -->
                <aside class="col-lg-4 col-xl-3 ml-xl-auto">
                    <div class="sidebar">
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
                </aside>
                <!-- sidebar end -->

            </div>
        </div>
    </section>
    <!-- Specifications section end -->
</x-frontend-layout>
