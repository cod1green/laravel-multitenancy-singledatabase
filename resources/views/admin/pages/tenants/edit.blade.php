@section('title',  __("Editar Company"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{__("Editar Company")}}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('tenantsEdit') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tenants.update', $tenant->id) }}" method="POST" class="form"
                  enctype="multipart/form-data">
                @method('PUT')
                @include('admin.pages.tenants._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
