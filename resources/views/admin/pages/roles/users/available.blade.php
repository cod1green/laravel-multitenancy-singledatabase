@section('title', __('Users available for the role') . ': ' . $role->name )

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Users available for the role') }}: <strong>{{$role->name}}</strong>
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('roleUsersAvailable', $role) }}
            </div>
        </div>
    </x-slot>

    <div class="card">
        <div class="div card-header px-4">
            @include('admin.includes.search', [
                'route' => route('roles.users.available', $role->id)
            ])
        </div>

        <div class="div card-body table-responsive">
            @include('admin.includes.alerts')

            <form action="{{ route('roles.users.attach', $role->id)}}" method="post">
                @csrf

                <table class="table table-condensed table-striped table-hover table-borderless align-middle">
                    <tbody>
                    <tr>
                        @foreach($users as $user)
                            <td class="align-middle">
                                <div class="form-group col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                    <div class="custom-control custom-switch custom-switch-on-success">
                                        <input type="checkbox" name="users[]" value="{{ $user->id }}"
                                               class="custom-control-input" id="{{ $user->id }}">
                                        <label class="custom-control-label" for="{{ $user->id }}">
                                            {{ $user->name }}
                                        </label>
                                    </div>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="align-middle">
                            @if (count($users) > 0)
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
                {!! $users->appends($filters)->onEachSide(5)->links() !!}
            @else
                {!! $users->onEachSide(5)->links() !!}
            @endif
        </div>
    </div>
</x-app-layout>
