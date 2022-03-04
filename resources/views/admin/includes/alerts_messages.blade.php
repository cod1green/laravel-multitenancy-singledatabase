@if (!empty($msg))
    <div class="alert alert-warning">
        <a href="javascript:history.back()" class="btn btn-dark float-right">
            <i class="fa fa-reply-all"></i> {{ __("Back") }}
        </a>
        <h5>
            <i class="icon fas fa-exclamation-triangle"></i>
            {{$msg}}
        </h5>
    </div>    
@endif