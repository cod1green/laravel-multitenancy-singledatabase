@section('title', __('Edit Role'))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Edit Role') }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('rolesEdit') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
