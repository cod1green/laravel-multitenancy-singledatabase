@section('title',  __("Register Table"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __("Register Table") }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('tablesCreate') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.store') }}" method="POST" class="form">
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
