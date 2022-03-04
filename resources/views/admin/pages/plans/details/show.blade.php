@section('title', __("View Detail"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __("View Detail") }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('PlansDetailsCreate', $plan)}}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3"><strong>{{ __("Name") }}: </strong> {{ $detail->name }}
        </div>

        <div class="card-footer">
            @include('admin.includes.button_delete', [
                'pathDelete' => route('permissions.destroy', $plan->url)
            ])
        </div>
    </div>
</x-app-layout>
