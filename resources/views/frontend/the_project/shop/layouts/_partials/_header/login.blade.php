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
                                <img class="user-image img-circle elevation-1 list-inline-item" width="32" height="32"
                                     src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"/>
                            @endif
                            <span class="d-none d-md-inline list-inline-item">{{ Auth::user()->name }}</span>
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
