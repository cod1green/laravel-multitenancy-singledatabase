@csrf

<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="row">
            <div class="col kv-avatar">
                <div class="file-loading">
                    <input id="avatar-1" name="logo" type="file">
                </div>
            </div>
            <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>

        </div>
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="form-group">
            @php $planId = $tenant->plan_id ?? old('plan_id') @endphp

            <label for="plan_id"> {{ __('Plan') }} *: </label>
            <select name="plan_id" id="plan_id" class="form-control js-basic-single"
                    @if (!empty($tenant)) disabled @endif>
                <option value="">{{ __('Selecione') }}</option>
                @foreach ($plans as $plan)
                    <option
                        @if($planId === $plan->id) selected @endif
                    value="{{ $plan->id }}">
                        {{ $plan->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="document"> {{ __('Document') }}</label>
            <input id="document" type="tel" name="document" value="{{ $tenant->document ?? old('document') }}"
                   class="form-control document" placeholder="{{ __('CPF or CNPJ') }}">
        </div>

        <div class="form-group">
            <label for="company"> {{ __('Company name') }}</label>
            <input type="text" id="company" name="company" value="{{ $tenant->company ?? old('company') }}"
                   class="form-control"
                   placeholder="{{ __('Company name') }}">
        </div>

        <div class="form-group">
            <label for="name"> {{ __('Name of responsible') }}</label>
            <input id="name" type="text" name="name" value="{{ $tenant->name ?? old('name') }}" class="form-control"
                   placeholder="{{ __('Complete name') }}">
        </div>

        <div class="form-group">
            <label for="phone"> {{ __('Phone or Cell phone') }}</label>
            <input id="phone" type="tel" name="phone" value="{{ $tenant->phone ?? old('phone') }}"
                   class="form-control phone" placeholder="{{ __('Phone or Cell phone') }}">
        </div>
    </div>

    <div class="form-group col-md-12">
        <label for="email"> {{ __('Email') }}</label>
        <input id="email" type="text" name="email" value="{{ $tenant->email ?? old('email') }}" class="form-control"
               placeholder="{{ __('Email') }}">
    </div>

    <div class="form-group col-md-12">
        <label for="about">{{ __('About') }}</label>
        <textarea id="about" name="about" placeholder="{{ __('Brief description about your company') }}"
                  class="form-control">{{trim($tenant->about ?? old('about'))}}</textarea>
    </div>

    <div class="form-group col-md-12">
        <label for="active">{{ __('Active') }}</label>
        <select id="active" name="active" class="form-control">
            <option value="Y" @if (isset($tenant) && $tenant->active == 'Y') selected @endif>{{ __('yes') }}</option>
            <option value="N" @if (isset($tenant) && $tenant->active == 'N') selected @endif>{{ __('no') }}</option>
        </select>
    </div>

    <div class="col-md-12">
        @include('admin.includes.button_save')
    </div>
</div>

@push('scripts')
    <script src="{{ mix('vendor/jquery.inputmask/jquery.inputmask.js')}}"></script>
    <script>
        $(function () {
            $(".document").inputmask({
                mask: ['999.999.999-99', '99.999.999/9999-99'],
                keepStatic: true
            });

            $(".phone").inputmask({
                mask: ['(99) 9999-9999', '(99) 99999-9999'],
                keepStatic: true
            });
        });
    </script>

    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/css/fileinput.min.css" media="all"
          rel="stylesheet" type="text/css"/>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/plugins/piexif.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/plugins/sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/fileinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/themes/fa/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.1/js/locales/LANG.js"></script>

    <!-- the fileinput plugin initialization -->
    <script>
        $("#avatar-1").fileinput({
            idioma: "pt-Br",
            theme: "fa",
            overwriteInitial: false,
            maxFileSize: 1500,
            maxFileCount: 1,
            showClose: false,
            showRemove: false,
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
            defaultPreviewContent: '<img src="{{ !empty($tenant->logo) ? url("storage/$tenant->logo") : url('images/company_none.png') }}" class="img-fluid" alt="{{ __('Logo') }}"><h6 class = "text-muted"> {{ !empty($tenant->logo) ? __('Click to change your logo') : __('Click to select your logo') }} </h6>',
            layoutTemplates: {
                main2: '{preview} {remove} {browse}'
            },
            allowedFileExtensions: ["jpeg", "jpg", "png", "gif"]
        });

    </script>
@endpush
