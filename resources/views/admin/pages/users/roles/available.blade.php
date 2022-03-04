@section('title',  __("Roles available for the user") . ': ' . $user->name)

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __("Roles available for the user") }}: <strong>{{$user->name}}</strong>
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('userRolesAvailable', $user) }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('users.roles.available', $user->id)
            ])
        </div>

        <div class="div card-body table-responsive">

            @include('admin.includes.alerts')

            <form action="{{ route('users.roles.attach', $user->id)}}" method="post">
                @csrf
                <table class="table table-condensed table-striped table-hover table-borderless align-middle">
                    <tbody>
                    <tr class="row mx-0">
                        @foreach ($roles as $role)
                            <td class="align-middle">

                                <div class="form-group col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                    <div class="custom-control custom-switch custom-switch-on-success">
                                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                               class="custom-control-input" id="{{ $role->id }}">
                                        <label class="custom-control-label" for="{{ $role->id }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="align-middle">
                            @if (count($roles) > 0)
                                @include('admin.includes.button_save', [
                                    'btnIcon' => 'link',
                                    'btnSave' => __('Link'),
                                ])
                            @else
                                @include('admin.includes.alerts_messages', ['msg' => __('messages.no_options_available') ])
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $roles->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $roles->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
</x-app-layout>
