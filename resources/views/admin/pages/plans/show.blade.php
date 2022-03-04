@section('title', __("View Plan"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{__("View Plan")}}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('plansView') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3"><strong>{{ __("Name") }}: </strong> {{ $plan->name }}</h5>
            <p class="card-text"><strong>{{ __("Url") }}:</strong> {{ $plan->url }}</p>
            <p class="card-text"><strong>{{ __("Price") }}:</strong> {{ number_format($plan->price, 2, ',', '.') }}</p>
            <p class="card-text"><strong>{{ __("Description") }}:</strong> {{ $plan->description }}</p>
        </div>

        <div class="card-footer">
            @include('admin.includes.button_delete', [
                'pathDelete' => route('permissions.destroy', $plan->url)
            ])
        </div>

    </div>
</x-app-layout>
