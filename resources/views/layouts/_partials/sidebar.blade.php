<aside class="main-sidebar sidebar-dark-teal elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <x-jet-application-mark width="36" class="brand-image img-circle elevation-1" style="opacity: .8"/>
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar User -->
        <div class="user-panel my-3 pb-3 d-flex">
            <a href="{{ route('profile.show') }}" class="d-inline-flex align-items-center"
               title="{{ __('Profile') }}">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="image">
                        <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle elevation-1" style="
                            height: 34px;
                            width: 34px;
                            max-height: 34px;
                            max-width: 34px;">
                    </div>
                @endif
                <div class="info">{{ Auth::user()->name }}</div>
            </a>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{
                        request()->routeIs('admin.dashboard') ? 'active font-weight-bolder' : ''
                    }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ __('Admin dashboard') }}</p>
                    </a>
                </li>

                @canany(['tenants', 'plans', 'groups'])
                    @php
                        $menuOpen = request()->is(
                            config('admin.prefix') . '/tenants*',
                            config('admin.prefix') . '/plans*',
                            config('admin.prefix') . '/groups*',
                        );
                    @endphp
                    <li class="nav-item has-treeview {{ $menuOpen ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $menuOpen ? 'active font-weight-bolder' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                {{ __('Companies manage') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('tenants')
                                <li class="nav-item">
                                    <a href="{{ route('tenants.index') }}" class="nav-link {{
                                        request()->is(config('admin.prefix') . '/tenants*') ? 'active font-weight-bolder' : ''
                                    }}">
                                        <i class="nav-icon fas fa-store"></i>
                                        <p>{{ __('Companies') }}</p>
                                    </a>
                                </li>
                            @endcan

                            @can('plans')
                                <li class="nav-item">
                                    <a href="{{ route('plans.index') }}" class="nav-link {{
                                    request()->is(config('admin.prefix') . '/plans*') ? 'active font-weight-bolder' : ''
                                    }}">
                                        <i class="nav-icon fas fa-map"></i>
                                        <p>{{ __('Plans') }}</p>
                                    </a>
                                </li>
                            @endcan

                            @can('groups')
                                <li class="nav-item">
                                    <a href="{{ route('groups.index') }}" class="nav-link {{
                                    request()->is(config('admin.prefix') . '/groups*') ? 'active font-weight-bolder' : ''
                                    }}">
                                        <i class="nav-icon fas fa-layer-group"></i>
                                        <p>{{ __('Groups') }}</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['users', 'roles', 'permissions'])
                    @php
                        $menuOpen = request()->is(
                            config('admin.prefix') . '/users*',
                            config('admin.prefix') . '/roles*',
                            config('admin.prefix') . '/permissions*',
                        );
                    @endphp
                    <li class="nav-item has-treeview {{ $menuOpen ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ $menuOpen ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                {{ __('Users manage') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('users')
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link {{
                                        request()->is(config('admin.prefix') . '/users*') ? 'active font-weight-bolder' : ''
                                    }}">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>{{ __('Users') }}</p>
                                    </a>
                                </li>
                            @endcan

                            @can('roles')
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link {{
                                    request()->is(config('admin.prefix') . '/roles*') ? 'active font-weight-bolder' : ''
                                }}">
                                        <i class="nav-icon fas fa-id-card"></i>
                                        <p>{{ __('Roles') }}</p>
                                    </a>
                                </li>
                            @endcan

                            @can('permissions')
                                <li class="nav-item">
                                    <a href="{{ route('permissions.index') }}" class="nav-link {{
                                    request()->is(config('admin.prefix') . '/permissions*') ? 'active font-weight-bolder' : ''
                                }}">
                                        <i class="nav-icon fas fa-lock"></i>
                                        <p>{{ __('Permissions') }}</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @can('pdv')
                    <li class="nav-item">
                        <a href="{{ route('sales.pdv') }}" class="nav-link {{
                            request()->is(config('admin.prefix') . '/sales*') ? 'active font-weight-bolder' : ''
                        }}">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p>{{ __('Ponto de Venda') }}</p>
                        </a>
                    </li>
                @endcan

                @can('orders')
                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="nav-link {{
                            request()->is(config('admin.prefix') . '/orders*') ? 'active font-weight-bolder' : ''
                        }}">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>{{ __('Orders') }}</p>
                        </a>
                    </li>
                @endcan

                @can('products')
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link {{
                            request()->is(config('admin.prefix') . '/products*') ? 'active font-weight-bolder' : ''
                        }}">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>{{ __('Products') }}</p>
                        </a>
                    </li>
                @endcan

                @can('categories')
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}" class="nav-link {{
                            request()->is(config('admin.prefix') . '/categories*') ? 'active font-weight-bolder' : ''
                        }}">
                            <i class="nav-icon fas fa-archive"></i>
                            <p>{{ __('Categories') }}</p>
                        </a>
                    </li>
                @endcan

                @can('tables')
                    <li class="nav-item">
                        <a href="{{ route('tables.index') }}" class="nav-link {{
                            request()->is(config('admin.prefix') . '/tables*') ? 'active font-weight-bolder' : ''
                        }}">
                            <i class="nav-icon fas fa-border-all"></i>
                            <p>{{ __('Tables') }}</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
