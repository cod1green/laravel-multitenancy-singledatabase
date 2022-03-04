@section('title', __('Registered Companies'))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Registered Companies') }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('tenants') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('tenants.search'),
                'add' => route('tenants.create')
            ])
        </div>

        <div class="div card-body table-responsive">
            @include('admin.includes.alerts')

            <table class="table table-condensed table-striped table-hover table-borderless align-middle">
                <thead>
                <tr>
                    <th scope="col">{{ __('Image') }}</th>
                    <th scope="col">{{ __('Company name') }}</th>
                    <th scope="col">{{ __('Document') }}</th>
                    <th scope="col" class="float-right mr-4">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tenants as $tenant)
                    <tr>
                        <td class="align-middle">
                            <img
                                src="{{ !empty($tenant->logo) ? url("storage/$tenant->logo") : url("images/company_none.png") }}"
                                alt='{{ $tenant->logo ?? $tenant->name }}'
                                width="100"
                                height="100"
                                class="img-fluid"
                            >
                        </td>
                        <td class="align-middle">
                            {{ $tenant->company }}
                        </td>

                        <td class="align-middle">
                            {{ $tenant->document }}
                        </td>

                        <td class="align-middle float-right">
                            @each('admin.includes.forms_actions', ['items' =>
                                [
                                    'route' => route('tenants.show', $tenant->id),
                                    'color' => 'secondary',
                                    'icon' => 'eye',
                                    'label' => 'Ver'
                                ],
                                [
                                    'route' => route('tenants.edit', $tenant->id),
                                    'color' => 'primary',
                                    'icon' => 'edit',
                                    'label' => 'Editar'
                                ]
                            ], 'item', 'admin.includes.forms_actions')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tenants->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $tenants->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
</x-app-layout>
