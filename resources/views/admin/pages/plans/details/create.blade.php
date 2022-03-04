@section('title', __('Plan Details') . ': ' . $plan->name)

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Plan Details') }}: <strong>{{ $plan->name }}</strong>
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('PlansDetailsCreate', $plan)}}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.plan.store', $plan->url)}}" method="post">
                @include('admin.pages.plans.details._partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
