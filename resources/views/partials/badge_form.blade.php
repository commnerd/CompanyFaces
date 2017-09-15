<form class="form-horizontal" role="form" method="POST" action="{{ $submissionRoute }}" enctype="multipart/form-data">
    @if(strtoupper($submissionMethod) !== 'POST')
        {{ method_field($submissionMethod) }}
    @endif
    {{ csrf_field() }}

    @include('partials.photo_input', ['model' => $badge])

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title" class="col-md-4 control-label">Title</label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $badge->title) }}">

            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-4 col-md-6">
            <h3>Badge Settings</h3>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="stand_alone" {{ $badge->stand_alone ? 'checked' : '' }}> Stand Alone (Only one owner at a time)
                </label>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-4 control-label">Description</label>

        <div class="col-md-6">
            <textarea id="description" type="text" class="form-control" name="description">{{ old('description', $badge->description) }}</textarea>

            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                {{ $submissionText }}
            </button>
        </div>
    </div>
</form>
