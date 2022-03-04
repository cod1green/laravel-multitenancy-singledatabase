<!-- sidebar start -->
<!-- ================ -->
<aside class="col-lg-3">
    <div class="sidebar">
        <div class="block clearfix">
            <h3 class="title">Categories</h3>
            <div class="separator-2"></div>
            <nav>
                <ul class="nav flex-column list-style-icons">
                    @foreach($categories as $category)
                        <li class="nav-item">
                            @if($category->icon)
                                <a class="nav-link {{ setActiveCategory($category->slug) }}"
                                   href="{{ route('shop.products.index', ['category' => $category->slug]) }}">
                                    <i class="{{ $category->icon }}"></i>{{ $category->name }}
                                </a>
                            @else
                                <a class="nav-link {{ request()->category === $category->slug ? 'active': '' }}"
                                   href="{{ route('shop.products.index', ['category' => $category->slug]) }}">
                                    </i>{{ $category->name }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        @include('frontend.the_project.shop.pages.products._partials.best-sellers')
        @include('frontend.the_project.shop.pages.products._partials.top-rated')
    </div>
</aside>
<!-- sidebar end -->
