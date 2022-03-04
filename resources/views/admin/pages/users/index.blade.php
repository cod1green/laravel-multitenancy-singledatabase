@section('title', __('Registered Users'))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Registered Users') }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('users') }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => route('users.search'),
                'add' => route('users.create')
            ])
        </div>

        <div class="div card-body table-responsive">
            @include('admin.includes.alerts')

            <table class="table table-condensed table-striped table-hover table-borderless align-middle">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col" class="float-right mr-4">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @each('admin.includes.forms_actions', ['items' =>
                                    [
                                        'route' => route('users.roles', $user->id ),
                                        'color' => 'info',
                                        'icon' => 'address-book',
                                        'label' => __('Roles')
                                    ],
                                    [
                                        'route' => route('users.show', $user->id ),
                                        'color' => 'secondary',
                                        'icon' => 'eye',
                                        'label' => __('View')
                                    ],
                                    [
                                        'route' => route('users.edit', $user->id ),
                                        'color' => 'primary',
                                        'icon' => 'edit',
                                        'label' => __('Edit')
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
                {!! $users->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $users->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
</x-app-layout>
