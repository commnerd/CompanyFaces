<form class="form-horizontal" role="form" method="POST" action="{{ route($route) }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="supervisor_user_id" value="0">

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="photo" class="col-md-4 control-label">Photo</label>

        <div class="col-md-6">
            <input id="photo" type="file" class="form-control" name="photo" value="{{ old('photo') }}">

            @if ($errors->has('photo'))
                <span class="help-block">
                    <strong>{{ $errors->first('photo') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @if(App\User::get()->count() > 0)
    <div class="form-group{{ $errors->has('supervisor') ? ' has-error' : '' }}">
        <label for="supervisor" class="col-md-4 control-label">Supervisor</label>

        <div class="col-md-6">
            <input id="supervisor" type="text" class="form-control" name="supervisor" value="{{ old('supervisor') }}" source="{{ route('searchUsers') }}">
            @if ($errors->has('supervisor'))
                <span class="help-block">
                    <strong>{{ $errors->first('supervisor') }}</strong>
                </span>
            @endif
        </div>
    </div>
    @endif

    <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
        <label for="position" class="col-md-4 control-label">Position</label>

        <div class="col-md-6">
            <input id="position" type="text" class="form-control" name="position" value="{{ old('position') }}">

            @if ($errors->has('position'))
                <span class="help-block">
                    <strong>{{ $errors->first('position') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">Password</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
        </div>
    </div>

    <div class="form-group{{ $errors->has('biography') ? ' has-error' : '' }}">
        <label for="biography" class="col-md-4 control-label">Biography</label>

        <div class="col-md-6">
            <textarea id="biography" type="text" class="form-control" name="biography">{{ old('biography') }}</textarea>

            @if ($errors->has('biography'))
                <span class="help-block">
                    <strong>{{ $errors->first('biography') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Register
            </button>
        </div>
    </div>
</form>
