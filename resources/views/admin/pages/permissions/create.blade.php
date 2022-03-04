@section('title', __('Register Permission'))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Register Permission') }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('permissionsCreate') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('permissions.store') }}" method="POST" class="form">
                @include('admin.pages.permissions._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
