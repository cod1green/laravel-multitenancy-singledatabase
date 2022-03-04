@section('title',  __('Edit Permission') . ': ' . $permission->name)

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Edit Permission') }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('permissionsEdit')}}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
