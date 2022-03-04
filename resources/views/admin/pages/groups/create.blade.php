@section('title', __("Register Group"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{__("Register Group")}}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('groupsCreate') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('groups.store') }}" method="POST" class="form">
                @include('admin.pages.groups._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
