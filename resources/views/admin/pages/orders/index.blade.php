@section('title', __('Registered Orders'))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Registered Orders') }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('orders') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <orders-tenant></orders-tenant>
    </div>
</x-app-layout>
