@extends('layouts.app')

@section('content')
<header class="row-fluid">
    <div>
        <h1 class="col-xs-12 center">{{ $user->name }}</h1>
    </div>
</header>
<section class="row-fluid">
    <div class="col-xs-12 col-sm-3 center">
        <img src="{{ $user->photo->url }}">
        <div class="email center"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
    </div>
    <div class="col-xs-12 col-sm-9">
        {{$user->biography}}
    <div>
</section>
<section class="row-fluid">
    <div class="col-xs-12 tabs">
        <ul>
            @if($user->supervisor !== NULL)
                <li><a href="#supervisors">Supervisor Chain</a></li>
            @endif
            @if($user->reports->count() !== 0)
                <li><a href="#reports">Reports</a></li>
            @endif
        </ul>
        <div id="supervisors">
            @if($user->supervisor !== NULL)
                    @for(
                        $i = 0, $supervisor = $user->supervisor;
                        $supervisor !== NULL;
                        $supervisor = $supervisor->supervisor, $i++
                    )
                        <a href="{{ route('users.show', [$supervisor->id]) }}">
                            <img src="{{ $supervisor->photo->url }}">
                        </a>
                    @endfor
            @endif
        </div>
        <div id="reports">
            @if($user->reports === NULL)
                <h3>This person is not a supervisor.</h3>
            @else
                    @foreach($user->reports as $report)
                        <a href="{{ route('users.show', [$report->id]) }}">
                            <img src="{{ $report->photo->url }}">
                        </a>
                    @endforeach
            @endif
        </div>
    </div>
</section>
<footer>

</footer>
@endsection
