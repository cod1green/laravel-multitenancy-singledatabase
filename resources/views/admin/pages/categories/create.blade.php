@section('title', __("Register Category"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __("Register Category") }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('categoriesCreate') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" class="form">
                @include('admin.pages.categories._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
