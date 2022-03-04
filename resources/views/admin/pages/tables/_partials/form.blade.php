@csrf

<div class="form-group">
    <label for="name"> {{ __("Identifier") }}: </label>
    <input type="text" name="name" value="{{ $table->name ?? old('name') }}" class="form-control" placeholder="{{ __("Identifier") }}:">
</div>

<div class="form-group">
    <label for="description"> {{ __("Description") }}: </label>
    <input type="text" name="description" value="{{ $table->description ?? old('description') }}" class="form-control" placeholder="{{ __("Description") }}:">
</div>

@include('admin.includes.button_save')