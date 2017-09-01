<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <div class="col-md-6 col-md-offset-3">
        <div class="image-drop form-control"></div>
        @if ($errors->has('photo'))
            <span class="help-block">
                <strong>{{ $errors->first('photo') }}</strong>
            </span>
        @endif
    </div>
</div>
