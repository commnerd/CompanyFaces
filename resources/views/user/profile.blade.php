@extends('layouts.app')

@section('content')
<header class="row">
    <div>
        <h1 class="col-xs-12 center">{{ $user->name }}</h1>
    </div>
</header>
<section class="row">
    <div class="col-xs-12 col-sm-3">
        <img src="{{ Storage::url($user->photo->image_path) }}">
        @include('partials.social', ['class' => 'upper', 'user' => $user])
    </div>
    <div class="col-xs-12 col-sm-9">
    @if($supervisor === NULL)
        <h3>This person is the {{ $user->position }}.</h3>
    @else
        <div>{{ $supervisor->name }}</div>
        @while(NULL !== ($supervisor = $supervisor->supervisor)):
            <div>{{ $supervisor->name }}</div>
        @endwhile
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
