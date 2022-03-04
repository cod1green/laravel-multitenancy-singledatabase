@if (session('success_message'))
    <div class="alert alert-success">
        <i class="fa fas fa-check"></i>
        {{ session('success_message') }}
    </div>
@endif

@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
