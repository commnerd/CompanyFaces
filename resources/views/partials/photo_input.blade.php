<div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
    <div class="col-md-6 col-md-offset-3">
        <div class="image-drop form-control">
            @if(isset($model->photo))
                <img src="{{ $model->photo->url }}" />
            @endif
        </div>
        <input type="hidden" name="photo" value="{{ old('photo', isset($model->photo) ?? $model->photo->name) }}" />
        <input type="hidden" name="photo_crop_x" value="{{ old('photo_crop_x') }}" />
        <input type="hidden" name="photo_crop_y" value="{{ old('photo_crop_y') }}" />
        <input type="hidden" name="photo_crop_w" value="{{ old('photo_crop_w') }}" />
        <input type="hidden" name="photo_crop_h" value="{{ old('photo_crop_h') }}" />
        <input type="hidden" name="photo_scale_x" value="{{ old('photo_scale_x') }}" />
        <input type="hidden" name="photo_scale_y" value="{{ old('photo_scale_y') }}" />

        @if ($errors->has('photo'))
            <span class="help-block">
                <strong>{{ $errors->first('photo') }}</strong>
            </span>
        @endif
    </div>
</div>
