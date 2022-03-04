<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{ url('images/user-profile-none.png')}}"
                alt="{{$user->name}}">
        </div>

        <h3 class="profile-username text-center">{{$user->username}}</h3>

        <p class="text-muted text-center">{{$user->roles->first()->name}}</p>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>{{__("Identify")}}</b> <a class="float-right">{{$user->uuid}}</a>
            </li>
            {{-- <li class="list-group-item">
                <b>{{__("identify")}}</b> <a class="float-right">{{$user->email}}</a>
            </li> --}}
            <li class="list-group-item">
                <b>{{__("Active")}}</b> <a class="float-right">{{__("{$user->active}")}}</a>
            </li>
        </ul>

        @if (auth()->user()->subscription('default'))
            <a href="{{ route('subscriptions.invoices') }}" class="btn btn-primary btn-block">
                <b>Minhas faturas</b>
            </a>            
        @endif

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- About Me Box -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Sobre</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <strong><i class="fas fa-building mr-1"></i> Empresa</strong>

        <p class="text-muted">
            {{$user->tenant->name}}
        </p>

        <hr>

        <strong><i class="fas fa-pencil-alt mr-1"></i> Meus Cargos </strong>

        <p class="text-muted">
            @foreach($user->roles as $role)
                <span class="badge badge-light">{{$role->name}} </span>
            @endforeach
        </p>

        <hr>

        <strong><i class="far fa-clock mr-1"></i> Cadastro </strong>

        <p class="text-muted">
            {{$user->created}}
        </p>

        <hr>

        <strong><i class="far fa-clock mr-1"></i> Última Atualização </strong>

        <p class="text-muted">
            {{$user->updated}}
        </p>

        <hr>

        @include('admin.includes.button_delete', [
            'pathDelete' => route('users.destroy', $user->id),
            'btnDelete' => __('Delete my account'),
            'noBtnBack' => true
            ])
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->