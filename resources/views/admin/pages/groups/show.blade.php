@section('title', __('View Group'))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('View Group') }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('groupsView') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3"><strong>{{ __("Name") }}: </strong> {{ $group->name }}</h5>
            <p class="card-text"><strong>{{ __("Description") }}:</strong> {{ $group->description }}</p>
        </div>

        <div class="card-footer">
            @include('admin.includes.button_delete', [
                'pathDelete' => route('groups.destroy', $group->id)
            ])
        </div>
    </div>
</x-app-layout>
