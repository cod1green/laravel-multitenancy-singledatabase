@include('admin.includes.alerts')

<div class="form-group mb-0">
    <button type="submit" class="btn btn-info"> 
        <i class="fa fa-{{ $btnIcon ?? 'save'}}"></i> {{ $btnSave ?? __("Save") }} 
    </button>
    <a href="javascript:history.back()" class="btn btn-default"> 
        <i class="fa fa-reply-all"></i> {{ $btnExit ?? __("Exit without saving") }} 
    </a>
</div>