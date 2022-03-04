@section('title', __("Edit User"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{__("Edit User") }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('usersEdit')}}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
