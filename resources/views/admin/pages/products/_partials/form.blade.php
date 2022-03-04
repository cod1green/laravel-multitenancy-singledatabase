@csrf

<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="row">
            <div class="col kv-avatar">
                <div class="file-loading">
                    <input id="avatar-1" name="image" type="file">
                </div>
            </div>
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>

        </div>
    </div>

    <div class="col-md-8">
        <div class="form-group">
            <label for="name"> {{ __('Name') }}: </label>
            <input type="text" name="name" value="{{ $product->name ?? old('name') }}" class="form-control"
                   placeholder="{{ __('Name') }}:">
        </div>

        <div class="form-group">
            <label for="description"> {{ __('Description') }}: </label>
            <textarea name="description" placeholder="{{ __('Description') }}:"
                      class="form-control">{{ $product->description ?? old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="price"> {{ __('Price') }}: </label>
            <input id="moedaReal" type="text" name="price" value="{{ $product->priceBr ?? old('price') }}"
                   class="form-control" placeholder="{{ __('Price') }}:">
        </div>

        @include('admin.includes.button_save')
    </div>
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/css/fileinput.min.css" media="all"
          rel="stylesheet" type="text/css"/>
@endpush

@push('scripts')
    <script src="{{ mix('vendor/jquery.inputmask/jquery.inputmask.js')}}"></script>
    <script>
        $(function () {
            $('#moedaReal').inputmask('decimal', {
                radixPoint: ",",
                groupSeparator: ".",
                autoGroup: true,
                digits: 2,
                digitsOptional: false,
                placeholder: '0',
                rightAlign: false,
                onBeforeMask: function (value, opts) {
                    return value;
                }
            });
        });

    </script>

    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/plugins/piexif.min.js"
            type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/plugins/sortable.min.js"
            type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/fileinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/themes/fa/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/locales/LANG.js"></script>

    <script>
        $("#avatar-1").fileinput({
            idioma: "pt-Br",
            theme: "fa",
            overwriteInitial: false,
            maxFileSize: 1500,
            maxFileCount: 1,
            showClose: false,
            showRemove: true,
            showCaption: false,
            showBrowse: false,
            browseOnZoneClick: true,
            browseLabel: '',
            removeLabel: '',
            initialPreviewAsData: true,
            browseIcon: '<i class="fas fa-folder-open"></i>',
            removeIcon: '<i class="fas fa-times"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="{{ !empty($product->image) ? url("storage/$product->image") : url('images/company_none.png') }}" class="img-fluid" alt="{{ __('Image') }}"><h6 class = "text-muted"> {{ !empty($product->image) ? __('Click to change your image') : __('Click to select your image') }} </h6>',
            layoutTemplates: {
                main2: '{preview} {remove} {browse}'
            },
            allowedFileExtensions: ["jpg", "jpeg", "png", "gif"]
        });

    </script>
@endpush
