@php
$btnClass = empty($noBtnBack) ? '' : 'btn-block' 
@endphp

<button type="button" class="btn btn-danger {{$btnClass}}" data-toggle="modal" data-target="#modal-delete">
    <i class="fas fa-trash"></i>
    {{$btnDelete ?? __("Delete")}}
</button>

@if (empty($noBtnBack))
    <a href="javascript:history.back()" class="btn btn-default"> 
        <i class="fa fa-reply-all"></i> {{ __("Exit without saving") }} 
    </a>   
@endif


<div class="modal modal-xl fade" id="modal-delete" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    {{ $titleModal ?? __("Delete this record") }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h5><i class="icon fas fa-exclamation-circle"></i>
                    {{ $titleText ?? __('Are you sure you want to delete this record?') }}
                </h5>
                <p>{{ $text ?? __('This action cannot be undone!') }}</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fas fa-ban"></i>
                    {{ $btnCancel ?? __('I do not want') }}
                </button>

                <form action="{{ $pathDelete }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i>
                        {{ $btnConfirm ?? __('I want to delete') }}
                    </button>
                </form>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
