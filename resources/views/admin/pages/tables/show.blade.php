@section('title',  __("View Table"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __("View Table") }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('tablesView')}}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <div class="card-body">
                <h5 class="card-title mb-3"><strong>{{ __("Name") }}: </strong> {{ $table->name }}</h5>
                <p class="card-text"><strong>{{ __("Description") }}:</strong> {{ $table->description }}</p>
            </div>

            <div class="card-footer">
                @include('admin.includes.button_delete', [
                    'pathDelete' => route('tables.destroy', $table->id)
                ])
            </div>
        </div>
    </div>
</x-app-layout>
