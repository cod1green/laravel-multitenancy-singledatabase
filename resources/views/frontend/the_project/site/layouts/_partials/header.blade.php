<!-- header-container start -->
<div class="header-container">
    <!-- header-top start -->
    <!-- classes:  -->
    <!-- "dark": dark version of header top e.g. class="header-top dark" -->
    <!-- "colored": colored version of header top e.g. class="header-top colored" -->
    <!-- ================ -->
    <div id="home" class="header-top colored">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-3 col-sm-6 col-lg-9">
                    <!-- header-top-first start -->
                    <!-- ================ -->
                    <div class="header-top-first clearfix">
                        <ul class="social-links circle small clearfix hidden-sm-down">
                            <li class="flickr">
                                <a href="#" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li class="facebook">
                                <a href="#" target="_blank">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li class="xing">
                                <a href="https://api.whatsapp.com/send?phone=5511948809185&text=Ol%C3%A1%2C%20quero%20fazer%20um%20or%C3%A7amento!"
                                   target="_blank">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>
                        </ul>
                        <div class="social-links hidden-md-up circle small">
                            <div class="btn-group dropdown">
                                <button id="header-top-drop-1" type="button"
                                        class="btn dropdown-toggle dropdown-toggle--no-caret" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-share-alt"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-animation" aria-labelledby="header-top-drop-1">
                                    <li class="flickr">
                                        <a href="#" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li class="facebook">
                                        <a href="#" target="_blank">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="xing">
                                        <a href="https://api.whatsapp.com/send?phone=5511948809185&text=Ol%C3%A1%2C%20quero%20fazer%20um%20or%C3%A7amento!"
                                           target="_blank"><i class="fab fa-whatsapp"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <ul class="list-inline hidden-md-down">
                            <li class="list-inline-item">
                                <i class="fa fa-map-marker pr-1 pl-2"></i>
                                R. Caminho Existente, 26 - Jardim Santana, Cotia-SP, 06719-257
                            </li>
                            <li class="list-inline-item"><i class="fa fa-phone pr-1 pl-2"></i>(011) 96933-9297</li>
                            <li class="list-inline-item"><i class="fa fa-envelope-o pr-1 pl-2"></i>
                                <a class="text-decoration-none" href="mailto:gestao.cod1green@gmail.com">gestao.cod1green@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                    <!-- header-top-first end -->
                </div>
                <div class="col-9 col-sm-6 col-lg-3">

                    <!-- header-top-second start -->
                    <!-- ================ -->
                    <div id="header-top-second" class="clearfix">

                        <!-- header top dropdowns start -->
                        <!-- ================ -->
                        <div class="header-top-dropdown text-right">
                            @guest
                                @if (Route::has('register'))
                                    <div class="btn-group">
                                        <a href="{{ route('register') }}" class="btn btn-default btn-sm"><i
                                                class="fa fa-user pr-2"></i>
                                            {{ __('Register') }}
                                        </a>
                                    </div>
                                @endif
                                <div class="btn-group">
                                    <a href="{{ route('login') }}" class="btn btn-default btn-sm"><i
                                            class="fa fa-lock pr-2"></i>
                                        {{ __('Login') }}
                                    </a>
                                </div>
                            @else
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                            id="header-drop-user" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <div class="list-inline my-0">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <img class="user-image img-circle elevation-1 list-inline-item"
                                                     width="32" height="32"
                                                     src="{{ Auth::user()->profile_photo_url }}"
                                                     alt="{{ Auth::user()->name }}"/>
                                            @endif
                                            <span
                                                class="d-none d-md-inline list-inline-item">{{ Auth::user()->name }}</span>
                                        </div>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="header-drop-user">
                                        @can('dashboard')
                                            <li class="dropdown-item">
                                                <a href="{{ route('admin.dashboard') }}">
                                                    <i class="fa fa-btn fa-tachometer-alt"></i> @lang('project.dashboard.title')
                                                </a>
                                            </li>
                                        @endcan

                                        <li class="dropdown-item">
                                            <a href="{{ route('profile.show') }}">
                                                <i class="fa fa-btn fa-id-card"></i> @lang('project.profile.title_singular')
                                            </a>
                                        </li>

                                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                            <li class="dropdown-item">
                                                <a href="{{ route('api-tokens.index') }}">
                                                    <i class="fa fa-btn fa-code"></i> {{ __('API Tokens') }}
                                                </a>
                                            </li>
                                        @endif

                                        <li class="dropdown-item">
                                            <a href="{{ route('subscriptions.invoices') }}">
                                                <i class="fa fa-btn fa-user-check"></i> {{ __('Minha Assinatura') }}
                                            </a>
                                        </li>

                                        <hr class="dropdown-divider">

                                        <li class="dropdown-item">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="fa fa-power-off"></i> @lang('global.logout')
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endguest
                        </div>
                        <!--  header top dropdowns end -->
                    </div>
                    <!-- header-top-second end -->
                </div>
            </div>
        </div>
    </div>
    <!-- header-top end -->

    <!-- header start -->
    <!-- classes:  -->
    <!-- "fixed": enables fixed navigation mode (sticky menu) e.g. class="header fixed clearfix" -->
    <!-- "fixed-desktop": enables fixed navigation only for desktop devices e.g. class="header fixed fixed-desktop clearfix" -->
    <!-- "fixed-all": enables fixed navigation only for all devices desktop and mobile e.g. class="header fixed fixed-desktop clearfix" -->
    <!-- "dark": dark version of header e.g. class="header dark clearfix" -->
    <!-- "centered": mandatory class for the centered logo layout -->
    <!-- ================ -->
    <header class="header fixed fixed-desktop clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-auto hidden-md-down d-flex align-items-center">
                    <!-- header-first start -->
                    <!-- ================ -->
                    <div class="header-first clearfix py-lg-1">

                        <!-- logo -->
                        <div id="logo" class="logo">
                            <a href="{{ route('site.home') }}">
                                <img id="logo_img" width="63" height="63"
                                     src="{{ asset('frontend/the_project/img/cod1green/logo_100x100.png')  }}"
                                     alt="Logo">
                            </a>
                        </div>

                        <!-- name-and-slogan -->
                        <!-- <div class="site-slogan">Seu slogan</div> -->
                    </div>
                    <!-- header-first end -->

                </div>
                <div class="col-lg-8 ml-auto">

                    <!-- header-second start -->
                    <!-- ================ -->
                    <div class="header-second clearfix">

                        <!-- main-navigation start -->
                        <!-- classes: -->
                        <!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
                        <!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
                        <!-- ================ -->
                        <div class="main-navigation main-navigation--mega-menu  animated">
                            <nav class="navbar navbar-expand-lg navbar-light p-0">
                                <div class="navbar-brand clearfix hidden-lg-up py-1">

                                    <!-- logo -->
                                    <div id="logo-mobile" class="logo">
                                        <a href="{{ route('site.home') }}">
                                            <img id="logo-img-mobile" width="50" height="50"
                                                 src="{{ asset('frontend/the_project/img/cod1green/logo_100x100.png')  }}"
                                                 alt="The Project">
                                        </a>
                                    </div>

                                    <!-- name-and-slogan -->
                                    <!-- <div class="site-slogan">Seu slogan</div> -->
                                </div>

                                <!-- Mobile -->
                                <!-- header dropdown buttons -->
                                <div class="header-dropdown-buttons hidden-lg-up p-0 ml-auto mr-3">
                                    <!-- <div class="btn-group">
                                        <button type="button" class="btn dropdown-toggle dropdown-toggle--no-caret" id="header-drop-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right dropdown-animation" aria-labelledby="header-drop-3">
                                            <li>
                                                <form role="search" class="search-box margin-clear">
                                                    <div class="form-group has-feedback">
                                                        <input type="text" class="form-control" placeholder="Search">
                                                        <i class="fa fa-search form-control-feedback"></i>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div> -->

                                    <div class="btn-group">
                                        <button type="button" class="btn dropdown-toggle dropdown-toggle--no-caret"
                                                id="header-drop-4" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <i class="fa fa-shopping-basket"></i>
                                            <!-- <span class="cart-count default-bg">8</span> -->
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
                                                    <!-- <tr>
                                                        <td class="quantity">2 x</td>
                                                        <td class="product"><a href="shop-product.html">Android 4.4 Smartphone</a><span class="small">4.7" Dual Core 1GB</span></td>
                                                        <td class="amount">$199.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="quantity">3 x</td>
                                                        <td class="product"><a href="shop-product.html">Android 4.2 Tablet</a><span class="small">7.3" Quad Core 2GB</span></td>
                                                        <td class="amount">$299.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="quantity">3 x</td>
                                                        <td class="product"><a href="shop-product.html">Desktop PC</a><span class="small">Quad Core 3.2MHz, 8GB RAM, 1TB Hard Disk</span></td>
                                                        <td class="amount">$1499.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="total-quantity" colspan="2">Total 8 Items</td>
                                                        <td class="total-amount">$1997.00</td>
                                                    </tr> -->
                                                    </tbody>
                                                </table>
                                                <div class="panel-body text-right">
                                                    <a href="#" class="btn btn-group btn-gray btn-sm">Ver
                                                        carrinho</a>
                                                    <a href="#" class="btn btn-group btn-gray btn-sm">Checkout</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- header dropdown buttons end -->

                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbar-collapse-1" aria-controls="navbar-collapse-1"
                                        aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse scrollspy" id="navbar-collapse-1">
                                    <!-- main-menu -->
                                    <ul class="navbar-nav ml-lg-auto">
                                        <li class="nav-item">
                                            <a class="nav-link smooth-scroll active" href="#home">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link smooth-scroll" href="#about">Sobre</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link smooth-scroll" href="#services">Serviços</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link smooth-scroll" href="#plans">Planos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link smooth-scroll" href="#footer">Contato</a>
                                        </li>
                                    </ul>
                                    <!-- main-menu end -->
                                </div>
                            </nav>
                        </div>
                        <!-- main-navigation end -->
                    </div>
                    <!-- header-second end -->

                </div>

                <!-- Desktop  -->
                <div class="col-auto hidden-md-down">
                    <!-- header dropdown buttons -->
                    <div class="header-dropdown-buttons">
                        <!-- <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle dropdown-toggle--no-caret" id="header-drop-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-search"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-animation" aria-labelledby="header-drop-1">
                                <li>
                                    <form role="search" class="search-box margin-clear">
                                        <div class="form-group has-feedback">
                                            <input type="text" class="form-control" placeholder="Search">
                                            <i class="fa fa-search form-control-feedback"></i>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div> -->

                        {{--                            <div class="btn-group">--}}
                        {{--                                <button type="button" class="btn dropdown-toggle dropdown-toggle--no-caret"--}}
                        {{--                                        id="header-drop-2" data-toggle="dropdown" aria-haspopup="true"--}}
                        {{--                                        aria-expanded="false">--}}
                        {{--                                    <i class="fa fa-shopping-basket"></i>--}}
                        {{--                                    <!-- <span class="cart-count default-bg">8</span> -->--}}
                        {{--                                </button>--}}
                        {{--                                <ul class="dropdown-menu dropdown-menu-right cart dropdown-animation"--}}
                        {{--                                    aria-labelledby="header-drop-2">--}}
                        {{--                                    <li>--}}
                        {{--                                        <table class="table table-hover">--}}
                        {{--                                            <thead>--}}
                        {{--                                            <tr>--}}
                        {{--                                                <th class="quantity">QTD</th>--}}
                        {{--                                                <th class="product">Produto</th>--}}
                        {{--                                                <th class="amount">Subtotal</th>--}}
                        {{--                                            </tr>--}}
                        {{--                                            </thead>--}}
                        {{--                                            <tbody>--}}
                        {{--                                            <!-- <tr>--}}
                        {{--                                                <td class="quantity">2 x</td>--}}
                        {{--                                                <td class="product"><a href="shop-product.html">Android 4.4 Smartphone</a><span class="small">4.7" Dual Core 1GB</span></td>--}}
                        {{--                                                <td class="amount">$199.00</td>--}}
                        {{--                                            </tr>--}}
                        {{--                                            <tr>--}}
                        {{--                                                <td class="quantity">3 x</td>--}}
                        {{--                                                <td class="product"><a href="shop-product.html">Android 4.2 Tablet</a><span class="small">7.3" Quad Core 2GB</span></td>--}}
                        {{--                                                <td class="amount">$299.00</td>--}}
                        {{--                                            </tr>--}}
                        {{--                                            <tr>--}}
                        {{--                                                <td class="quantity">3 x</td>--}}
                        {{--                                                <td class="product"><a href="shop-product.html">Desktop PC</a><span class="small">Quad Core 3.2MHz, 8GB RAM, 1TB Hard Disk</span></td>--}}
                        {{--                                                <td class="amount">$1499.00</td>--}}
                        {{--                                            </tr>--}}
                        {{--                                            <tr>--}}
                        {{--                                                <td class="total-quantity" colspan="2">Total 8 Items</td>--}}
                        {{--                                                <td class="total-amount">$1997.00</td>--}}
                        {{--                                            </tr> -->--}}
                        {{--                                            </tbody>--}}
                        {{--                                        </table>--}}
                        {{--                                        <div class="panel-body text-right">--}}
                        {{--                                            <a href="#" class="btn btn-group btn-gray btn-sm">Ver carrinho</a>--}}
                        {{--                                            <a href="#" class="btn btn-group btn-gray btn-sm">Checkout</a>--}}
                        {{--                                        </div>--}}
                        {{--                                    </li>--}}
                        {{--                                </ul>--}}
                        {{--                            </div>--}}
                    </div>
                    <!-- header dropdown buttons end -->
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
</div>
<!-- header-container end -->
