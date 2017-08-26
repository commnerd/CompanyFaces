@extends('layouts.app')

@section('content')
<header class="row-fluid">
    <div>
        <h1 class="col-xs-12 center">{{ $user->name }}</h1>
    </div>
</header>
<section class="row-fluid">
    <div class="col-xs-12 col-sm-3 center">
        <img src="{{ Storage::url($user->photo->image_path) }}">
        @include('partials.social', ['class' => 'upper', 'user' => $user])
    </div>
    <div class="col-xs-12 col-sm-9">
        <div class="tabs">
            <ul>
                @if($user->supervisor !== NULL)
                    <li><a href="#supervisors">Supervisor Chain</a></li>
                @endif
                @if($user->reports !== NULL)
                    <li><a href="#reports">Reports</a></li>
                @endif
            </ul>
            <div id="supervisors">
            @if($user->supervisor === NULL)
                <h3>This person is the {{ $user->position }}.</h3>
            @else
                    @for(
                        $i = 0, $supervisor = $user->supervisor;
                        $supervisor !== NULL;
                        $supervisor = $supervisor->supervisor, $i++
                    )
                        <img src="{{ Storage::url($supervisor->photo->image_path) }}">
                    @endfor
            @endif
            </div>
            <div id="reports">
            @if($user->reports === NULL)
                <h3>This person is not a supervisor.</h3>
            @else
                    @foreach($user->reports as $report)
                        <img src="{{ Storage::url($report->photo->image_path) }}">
                    @endforeach
            @endif
            </div>
        </div>
    <div>
</section>
<section class="row-fluid">
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
