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
                        <a href="{{ route('shop.home') }}">
                            <img id="logo_img" width="63" height="63"
                                 src="{{ asset('frontend/the_project/img/ctforcabruta/logo.png')  }}"
                                 alt="Logo">
                        </a>
                    </div>

                    <!-- name-and-slogan -->
                    <!-- <div class="site-slogan">Seu slogan</div> -->
                </div>
                <!-- header-first end -->

            </div>

            <div class="col-md-auto ml-auto">

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
                                    <a href="{{ route('shop.home') }}">
                                        <img id="logo-img-mobile" width="50" height="50"
                                             src="{{ asset('frontend/the_project/img/ctforcabruta/logo.png')  }}"
                                             alt="The Project">
                                    </a>
                                </div>

                                <!-- name-and-slogan -->
                                <!-- <div class="site-slogan">Seu slogan</div> -->
                            </div>

                            <!-- Mobile -->
                            <!-- header dropdown buttons -->
                            <div class="header-dropdown-buttons hidden-lg-up p-0 ml-auto mr-3">
                                @include('frontend.the_project.shop.layouts._partials._header._search.mobile')
                                @include('frontend.the_project.shop.layouts._partials._header._cart.mobile')
                                @include('frontend.the_project.shop.layouts._partials._header._user.desktop-mobile')
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
                                        <a class="nav-link smooth-scroll active" href="{{ route('shop.home') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link smooth-scroll" href="{{ route('shop.home', '#about') }}">Sobre</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link smooth-scroll" href="#class">Aulas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link smooth-scroll" href="#team">Time</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('shop.products.index') }}">Loja</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link smooth-scroll" href="#partners">Parceiros</a>
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
                    @include('frontend.the_project.shop.layouts._partials._header._search.desktop')

                    @include('frontend.the_project.shop.layouts._partials._header._cart.desktop')

                    @include('frontend.the_project.shop.layouts._partials._header._user.desktop-mobile')
                </div>
                <!-- header dropdown buttons end -->
            </div>
        </div>
    </div>
</header>
<!-- header end -->
