@section('title', __("Edit Table"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{  __("Edit Table") }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('tablesEdit')}}{{ Breadcrumbs::render('admin') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
