@section('title', __('Register Role'))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Register Role') }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('rolesCreate') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST" class="form">
                @include('admin.pages.roles._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
