@section('title', __('Registered Products'))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Registered Products') }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('products') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('products.search'),
                'add' => route('products.create')
            ])
        </div>

        <div class="div card-body table-responsive">
            @include('admin.includes.alerts')

            <table class="table table-condensed table-striped table-hover table-borderless align-middle">
                <thead>
                <tr>
                    <th scope="col">{{ __('Image') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Price') }}</th>
                    <th scope="col" class="float-right mr-4">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="align-middle">
                            <img
                                src="{{ $product->imageUrl() }}"
                                alt='{{ $product->name }}'
                                width="100"
                                height="100"
                                class="img-fluid"
                            >
                        </td>
                        <td class="align-middle">
                            {{ $product->name }}
                        </td>
                        <td class="align-middle">
                            R$ {{ $product->priceBr }}
                        </td>
                        <td class="align-middle float-right">
                            @each('admin.includes.forms_actions', ['items' =>
                                [
                                    'route' => route('products.categories', $product->id),
                                    'color' => 'info',
                                    'icon' => 'archive',
                                    'label' => 'Categorias'
                                ],
                                [
                                    'route' => route('products.show', $product->id),
                                    'color' => 'secondary',
                                    'icon' => 'eye',
                                    'label' => 'Ver'
                                ],
                                [
                                    'route' => route('products.edit', $product->id),
                                    'color' => 'primary',
                                    'icon' => 'edit',
                                    'label' => 'Editar'
                                ]
                            ], 'item', 'admin.includes.forms_actions')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $products->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $products->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
</x-app-layout>
