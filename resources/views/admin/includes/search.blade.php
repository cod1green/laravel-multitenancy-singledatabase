<div class="row">
    <div class="col">
        @if (!empty($add))
            <a href="{{ $add ?? '#' }}" class="btn btn-success mb-2">
                <i class="fas fa-{{ $icon ?? 'plus-square' }}"></i>
                {{ Str::upper( $label ??  __('Novo') ) }}
            </a>
        @endif
    </div>

    <div class="col float-right">
        <form action="{{ $route ?? '' }}" method="post" class="form">
            @if ($route)
                <div class="input-group">
                    @csrf
                    <input type="text" name="filter" placeholder="{{__('Filter')}}" value="{{ $filters['filter'] ?? '' }}"
                        class="form-control">
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            @endif
        </form>
    </div>
</div>
