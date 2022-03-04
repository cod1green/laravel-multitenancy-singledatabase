@section('title', __("Edit Product"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __("Edit Product") }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('productsEdit')}}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" class="form"
                  enctype="multipart/form-data">
                @method('PUT')
                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
