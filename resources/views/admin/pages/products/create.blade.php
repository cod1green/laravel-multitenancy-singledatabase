@section('title', __("Register Product"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __("Register Product") }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('productsCreate') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" class="form" enctype="multipart/form-data">
                @include('admin.pages.products._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
