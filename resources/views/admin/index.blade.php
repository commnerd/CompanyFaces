@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row-fluid">
        <div class="col-md-6">
            <fieldset>
                <legend>Data</legend>
                <ul>
                    <li>
                        <a href="{{ route('admin.users.index') }}">Users</a>
                    </li>
                    @if(Setting::show('badges'))
                    <li>
                        <a href="{{ route('admin.badges.index') }}">Badges</a>
                    </li>
                    @endif
                </ul>
            </fieldset>
        </div>
        <div class="col-md-6">
            @include('partials.settings_form', ['settings' => $settings])
        </div>
    </div>
</div>
@endsection
