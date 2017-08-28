@extends('layouts.app')

@section('content')
<div style="position:absolute; top:51px; bottom:0; left:0; right:0; z-index: -1;">
    @foreach($users as $user)
        <a href="{{ route('users.show', $user->id) }}">
            <img src="{{ Storage::url($user->photo->image_path) }}" />
        </a>
    @endforeach
</div>
<div class="row-fluid">
    <form class="search-form" action="{{ route('search') }}" method="get">
        <div class="row-fluid">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Search</div>

                    <div class="panel-body">
                        <input text="text" name="terms" class="form-control" placeholder="Search" source="{{ route('searchUsers') }}" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
