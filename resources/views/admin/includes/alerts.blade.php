@if ($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if (session('message'))
    <div class="alert alert-success">
        <i class="icon fas fa-check-circle"></i>
        {{ session('message') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        <i class="icon fas fa-exclamation-circle"></i>
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-warning">
        <i class="icon fas fa-exclamation-triangle"></i>
        {{ session('info') }}
    </div>
@endif