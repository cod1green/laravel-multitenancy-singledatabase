@guest
    <div class="btn-group">
        <a href="{{ route('login') }}" class="btn">
            <i class="fa fa-user fa-lg"></i>
        </a>
    </div>
@else
    <div class="btn-group">
        <button type="button" class="btn btn-img dropdown-toggle dropdown-toggle--no-caret"
                id="header-drop-user" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <img class="img-user img-circle elevation-1 list-inline-item"
                     src="{{ Auth::user()->profile_photo_url }}"
                     alt="{{ Auth::user()->name }}"/>
            @endif
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
