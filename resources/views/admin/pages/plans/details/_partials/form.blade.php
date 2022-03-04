@csrf
<div class="form-group">
    <label for="name"> {{ __("Name") }}: </label>
    <input id="name" type="text" name="name" value="{{ $detail->name ?? old('name') }}" placeholder="{{ __("Name") }}:" class="form-control">
</div>

@include('admin.includes.button_save')