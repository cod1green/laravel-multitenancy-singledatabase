@section('title', __('Register Plan'))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{__("Register Plan")}}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('plansCreate') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.store') }}" method="POST" class="form">
                @include('admin.pages.plans._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
