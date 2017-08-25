@extends('layouts.app')

@section('content')
<header class="row">
    <div>
        <h1 class="col-xs-12 center">{{ $user->name }}</h1>
    </div>
</header>
<section class="row">
    <div class="col-xs-12 col-sm-3 center">
        <img src="{{ Storage::url($user->photo->image_path) }}">
        @include('partials.social', ['class' => 'upper', 'user' => $user])
    </div>
    <div class="col-xs-12 col-sm-9">
    @if($supervisor === NULL)
        <h3>This person is the {{ $user->position }}.</h3>
    @else
        <carousel-3d>
        <slide :index=0>{{ $supervisor->name }}</slide>
        @for($supervisor = $supervisor->supervisor, $i = 1; NULL !== ($supervisor = $supervisor->supervisor); $i++):
            <slide :index={{ $i }}>{{ $supervisor->name }}</slide>
        @endfor
        <carousel-3d>
    @endif
    </ul>
</section>
<section class="row">
    <div class="col-xs-12 col-sm-3">
        @include('partials.social', ['class' => 'lower', 'user' => $user])
    </div>
    <div class="col-xs-12 col-sm-9">
        <h1 class="center">Bio</h1>
        <div class="biography">
            {{$user->biography}}
        </div>
    </div>
</section>
<footer>

</footer>
@endsection
