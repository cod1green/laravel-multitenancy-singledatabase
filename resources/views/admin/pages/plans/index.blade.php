@section('title', __('Registered Plans'))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{__("Registered Plans")}}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('plans') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('plans.search'),
                'add' => route('plans.create')
            ])
        </div>

        <div class="div card-body table-responsive">
            @include('admin.includes.alerts')

            <table class="table table-condensed table-striped table-hover table-borderless align-middle">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Price') }}</th>
                        <th scope="col" class="float-right mr-4">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($plans as $plan)
                        <tr>
                            <td class="align-middle">{{ $plan->name }}</td>
                            <td class="align-middle">R$ {{ number_format($plan->price, 2, ',', '.') }}</td>
                            <td class="align-middle float-right">
                                @each('admin.includes.forms_actions', ['items' =>
                                    [
                                        'route' => route('details.plan.index', $plan->url),
                                        'color' => 'info',
                                        'icon' => 'plus',
                                        'label' => __('Details')
                                    ],
                                    [
                                        'route' => route('plans.groups', $plan->id),
                                        'color' => 'dark',
                                        'icon' => 'layer-group',
                                        'label' => __('Groups')
                                    ],
                                    [
                                        'route' => route('plans.show', $plan->url),
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => __('View')
                                    ],
                                    [
                                        'route' => route('plans.edit', $plan->url),
                                        'color' => 'primary',
                                        'icon' => 'edit',
                                        'label' => __('Edit')
                                    ]
                                ], 'item', 'admin.includes.forms_actions')
                            </td>
                        </tr>
                    @empty
                        @include('admin.includes.alerts_messages', ['msg' => __('messages.empty_register') ])
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $plans->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $plans->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
</x-app-layout>
