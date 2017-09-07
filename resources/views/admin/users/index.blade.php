@extends('layouts.app')

@section('content')
<div>
    <ul>
        @foreach($users as $user)
            <li class="list-container">
                <img src="{{ $user->photo->variant('search')->url }}" />
                <h3>
                    <a href="{{route('admin.users.edit', ['user' => $user])}}">{{ $user->name }}</a>
                </h3>
                <span>{{ $user->position }}</span>
                <a href="{{ route('admin.users.destroy', ['user' => $user]) }}">Delete</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
