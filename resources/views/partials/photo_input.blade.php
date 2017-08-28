@if(old('photo'))
    {{ dd(old('photo')) }}
@else
    <input id="photo" type="file" class="form-control" name="photo" value="{{ old('photo') }}">
    @if ($errors->has('photo'))
        <span class="help-block">
            <strong>{{ $errors->first('photo') }}</strong>
        </span>
    @endif
@endif
