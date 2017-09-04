@extends('layouts.app')

@section('content')
<form class="search-form" action="{{ route('search') }}" method="get">
    <div class="panel panel-default">
        <div class="panel-heading">Search</div>
        <div class="panel-body">
            <input text="text" name="terms" class="form-control" placeholder="Search" source="{{ route('search.users') }}" />
        </div>
    </div>
</form>
<div class="home_background">
    @foreach($users as $user)
        <a href="{{ route('users.show', $user->id) }}">
            <img src="{{ $user->photo->url }}" />
        </a>
    @endforeach
</div>

@endsection
