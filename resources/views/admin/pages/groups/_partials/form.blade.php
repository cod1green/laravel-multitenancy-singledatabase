@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label for="name"> {{ __('Name') }} </label>
    <input type="text" name="name" value="{{ $group->name ?? old('name') }}" class="form-control">
</div>

<div class="form-group">
    <label for="description"> {{ __('Description') }} </label>
    <input type="text" name="description" value="{{ $group->description ?? old('description') }}" class="form-control">
</div>

@include('admin.includes.button_save')