@section('title', __('Edit detail') . ': ' . $detail->name )

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Edit detail') }}: <strong>{{ $detail->name }}</strong>
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('PlansDetailsEdit', $plan)}}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.plan.update', [$plan->url,$detail->id])}}" method="post">
                @method('PUT')
                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
