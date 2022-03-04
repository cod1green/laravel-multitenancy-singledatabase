@section('title', __("Register User"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __("Register User") }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('usersCreate') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST" class="form">
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
