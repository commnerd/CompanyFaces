@extends('layouts.app')

@section('content')
<header class="row-fluid">
    <div>
        <h1 class="col-xs-12 col-sm-6 col-sm-offset-3 center">{{ $badge->title }}</h1>
    </div>
</header>
<section class="row-fluid">
    <div class="col-xs-12 col-sm-6 col-sm-offset-3 center">
        <img src="{{ $badge->photo->variant('profile')->url }}">
    </div>
    <div class="col-xs-12 col-sm-6 col-sm-offset-3">
        {!! $badge->description !!}
    <div>
    <div class="col-xs-12 col-sm-6 col-sm-offset-3 center">
        <h3>Users with {{$badge->title}}</h3>
        @foreach($badge->users as $user)
            <a href="{{ route('users.show', ['user' => $user]) }}">
                <img src="{{ $user->photo->variant('mini')->url }}" alt="{{ $user->name }}" />
            </a>
        @endforeach
</section>
<footer>

</footer>
@endsection
