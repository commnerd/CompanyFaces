@extends('layouts.app')

@section('content')

<header>
    <h1>{{ $user->name }}</h1>
</header>
<aside>
    <img src="{{ Storage::url($user->photo->image_path) }}">
    <ul>
        <li><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
    </ul>
</aside>
<section>
    <ul>
    @if($supervisor === NULL)
        <li>This person is the {{ $user->position }}.</li>
    @else
        <li>{{ $supervisor->name }}</li>
        @while(NULL !== ($supervisor = $supervisor->supervisor)):
            <li>{{ $supervisor->name }}</li>
        @endwhile
    @endif

    </ul>
    <div>
        <h1>Bio</h1>
        {{$user->biography}}
    </div>
</section>
<footer>

</footer>
@endsection
