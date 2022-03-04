<div class="btn-group">
    <button type="button" class="btn dropdown-toggle dropdown-toggle--no-caret"
            id="header-drop-3" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
        <i class="fa fa-search"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-right dropdown-animation"
        aria-labelledby="header-drop-3">
        <li>
            <form action="{{ route('shop.products.search') }}" method="GET" role="search"
                  class="search-form search-box margin-clear">
                <div class="form-group has-feedback">
                    <input name="filter" type="text" value="{{ request()->input('query') }}" class="form-control"
                           placeholder="Pesquisar">
                    <i class="fa fa-search form-control-feedback"></i>
                </div>
            </form>
        </li>
    </ul>
</div>
