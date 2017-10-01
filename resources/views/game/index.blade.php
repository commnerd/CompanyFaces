@extends('layouts.app')

@section('content')
<header class="row-fluid">
    <div>
        <h1 class="col-xs-12 center">
            Who is this?
        </h1>
    </div>
</header>
<section class="row-fluid">
    <div class="col-xs-12 col-sm-4 center">
        <img src="{{ $user->photo->variant('profile')->url }}">
    </div>
    <form class="" action="{{ route('game.store') }}" method="post">
        {{ csrf_field() }}
        <div class="col-xs-12 col-sm-8">
            <ul>
                @foreach($names as $name)
                <li>
                    <label>
                        <input type="radio" name="name" value="{{ $name }}" onclick="javascript:submit()"> {{ $name }}
                    </label>
                </li>
                @endforeach
            </ul>
        </div>
    </form>
</section>
@endsection
