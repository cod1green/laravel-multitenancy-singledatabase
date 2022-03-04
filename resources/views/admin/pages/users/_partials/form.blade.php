    @csrf
    <div class="alert alert-default-info">
        <p> Os campos com (*) são obrigatórios!</p>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name"> {{ __('Name') }} *: </label>
            <input id="name" type="text" name="name" value="{{ $user->name ?? old('name') }}" class="form-control"
                placeholder="{{ __('Name') }}:">
        </div>
        <div class="form-group col-md-6">
            <label for="username"> {{ __('Username') }}: </label>
            <input id="username" type="text" name="username" value="{{ $user->username ?? old('username') }}" class="form-control"
                placeholder="{{ __('Username') }}:">
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cpfcnpj"> {{ __('Document') }}: </label>
            <input id="cpfcnpj" type="text" name="document" value="{{ $user->document ?? old('document') }}" class="form-control"
                placeholder="{{ __('Document') }}:">
        </div>
    
        <div class="form-group col-md-6">
            <label for="email"> {{ __('Email') }} *: </label>
            <input id="email" type="text" name="email" value="{{ $user->email ?? old('email') }}" class="form-control"
                placeholder="{{ __('Email') }}:">
        </div>
    </div>


    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="sex"> {{ __('Sex') }}: </label>
            <select id="sex" name="sex" class="form-control">
                <option value="M" @if (!empty($user) && $user->sex == 'M') checked @endif>
                    {{ __('male') }} </option>
                <option value="F" @if (!empty($user) && $user->sex == 'F') checked @endif>
                    {{ __('female') }} </option>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="phone"> {{ __('Cellular phone') }}: </label>
            <input id="phone" type="text" name="phone" value="{{ $user->phone ?? old('phone') }}" class="form-control"
                placeholder="{{ __('Cellular phone') }}:">
        </div>

        <div class="form-group col-md-4">
            <label for="birth"> {{ __('Birth') }}: </label>
            <input id="birth" type="text" name="birth" value="{{ $user->birth_date ?? old('birth') }}"
                class="form-control" placeholder="{{ __('Birth') }}:">
        </div>
    </div>
    {{-- <div class="form-group">
        <label for="email"> {{ __('Password') }}: </label>
        <input type="password" name="password" value="{{ old('password') }}" class="form-control"
            placeholder="{{ __('Password') }}:">
    </div> --}}

    <div class="form-group">
        <label for="bio"> {{ __('About') }}: </label>
        <textarea name="bio" id="bio" class="form-control">{{ $user->bio ?? '' }}</textarea>
    </div>

    @include('admin.includes.button_save')

@push('scripts')
    <script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
    <script>
        $(function() {
            $('#phone').inputmask('(99) 99999-9999', {
                'placeholder': '(99) 99999-9999'
            })
            $('#birth').inputmask('99/99/9999', {
                'placeholder': '99/99/9999'
            })

            $("input[id*='cpfcnpj']").inputmask({
                mask: ['999.999.999-99', '99.999.999/9999-99'],
                keepStatic: true
            });
        });

    </script>
@endpush
