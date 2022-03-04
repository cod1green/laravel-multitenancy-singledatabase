@section('title', __("Edit Group"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __("Edit Group") }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('groupsEdit') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('groups.update', $group->id) }}" method="POST" class="form">
                @method('PUT')
                @include('admin.pages.groups._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
