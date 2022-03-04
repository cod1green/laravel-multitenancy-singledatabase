@section('title', __("User Roles") . ': ' . $user->name)

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __("User Roles") }}: <strong>{{$user->name}}</strong>
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('userRoles', $user) }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="div card-header">
            @include('admin.includes.search', [
                'route' => null,
                'add' => route('users.roles.available', $user->id),
                'label' => __("Link"),
                'icon' => 'link'
            ])
        </div>

        <div class="div card-body table-responsive">

            @include('admin.includes.alerts')

            <table class="table table-condensed table-striped table-hover table-borderless align-middle">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th scope="col" class="float-right mr-4">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td class="align-middle">{{ $role->name }}</td>
                            <td class="align-middle float-right">
                                @each('admin.includes.forms_actions', ['items' =>
                                    [
                                        'route' => route('users.roles.detach', [$user->id, $role->id]),
                                        'color' => 'danger',
                                        'icon' => 'unlink',
                                        'label' => __("Unlink")
                                    ]
                                ], 'item')
                             </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="500">
                                @include('admin.includes.alerts_messages', ['msg' => __('messages.no_link_yet') ])
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
