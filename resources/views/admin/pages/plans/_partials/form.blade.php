@csrf

<div class="form-group">
    <label for="name"> {{ __("Name") }}: </label>
    <input type="text" name="name" value="{{ $plan->name ?? old('name') }}" class="form-control" placeholder="{{ __("Name") }}:">
</div>

<div class="form-group">
    <label for="period">{{ __("Period") }}:</label>
    <select name="period" class="form-control" id="period">
        <option value="month">{{ __("month") }}</option>
        <option value="trimester">{{ __("trimester") }}</option>
        <option value="semester">{{ __("semester") }}</option>
        <option value="year">{{ __("year") }}</option>
    </select>
</div>

<div class="form-group">
    <label for="price"> {{ __("Price") }}: </label>
    <input id="moedaReal" type="text" name="price" value="{{ $plan->price ?? old('price') }}" class="form-control"
        placeholder="{{ __("Price") }}:">
</div>

<div class="form-group">
    <label for="description"> {{ __("Description") }}: </label>
    <input type="text" name="description" value="{{ $plan->description ?? old('description') }}" class="form-control"
        placeholder="{{ __("Description") }}:">
</div>

<div class="form-group">
    <label for="strip_id"> {{ __("Plan identifier in stripe") }}: </label>
    <input type="text" name="stripe_id" value="{{ $plan->stripe_id ?? old('stripe_id') }}" class="form-control"
        placeholder="{{ __("Plan identifier in stripe") }}:">
</div>

<div class="form-group">
    <label for="yes">{{ __("Recommended") }}</label>
    <div class="custom-control custom-radio">
        <input type="radio" name="recommended" value="1" @if (!empty($plan->recommended)) checked @endif class="custom-control-input" id="yes">
        <label for="yes" class="custom-control-label">{{ __("yes") }}</label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" name="recommended" value="0" @if (empty($plan->recommended)) checked @endif class="custom-control-input" id="no">
        <label for="no" class="custom-control-label">{{ __("no") }}</label>
    </div>
</div>

@include('admin.includes.button_save')

@push('scripts')
    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
    <script>
        $(function() {
            $('#moedaReal').inputmask('decimal', {
                radixPoint: ".",
                groupSeparator: ",",
                autoGroup: true,
                digits: 2,
                digitsOptional: false,
                placeholder: '0',
                rightAlign: false,
                onBeforeMask: function(value, opts) {
                    return value;
                }
            });
        });

    </script>
@endpush