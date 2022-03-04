@section('title', __("Show Product"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{__("Show Product")}}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('productsView', $product)}}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <ul class="products-list product-list-in-card pl-2 pr-2">
                <li class="item">
                    <div class="product-img">
                        <img
                            src="{{ $product->imageUrl() }}"
                            alt='{{ $product->name }}' width="img-size-250">
                    </div>
                    <div class="product-info">
                        <a href="{{ route('products.edit', $product->id) }}"
                           class="product-title"> {{ $product->name }}
                            <span class="badge badge-light float-right">
                                R$ {{ $product->price_br }}
                            </span>
                        </a>
                        <span class="product-description">
                            {{ $product->description }}
                        </span>
                    </div>
                </li>
                <li>
                    <strong> {{ __("UUID") }}: </strong> {{ $product->uuid}}
                </li>
                <li>
                    <strong> {{ __("Created At") }}: </strong> {{ $product->created }}
                </li>
                <li>
                    <strong> {{ __("Updated At") }}: </strong> {{ $product->updated}}
                </li>
            </ul>

        </div>

        <div class="card-footer">
            @include('admin.includes.button_delete', [
                'pathDelete' => route('products.destroy', $product->id)
            ])
        </div>
    </div>
</x-app-layout>
