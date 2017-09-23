@extends('layouts.app')

@section('content')
<header class="row-fluid">
    <div>
        <h1 class="col-xs-12 center">
            {{ $user->name }}
            @if(NULL !== Auth::user() && Auth::user()->superuser)
                <a href="{{ route('admin.users.edit', ['user' => $user]) }}" class="fa fa-pencil-square-o" aria-hidden="true" title="Edit"></a>
                @if(Setting::show('badges'))
                    <a href="{{ route('admin.badges.assign', ['user' => $user]) }}" class="fa fa-bookmark-o" aria-hidden="true" title="Manage Badges"></a>
                @endif
            @endif
        </h1>
    </div>
</header>
<section class="row-fluid">
    <div class="col-xs-12 col-sm-3 center">
        <img src="{{ $user->photo->variant('profile')->url }}">
        <div class="email center"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
    </div>
    <div class="col-xs-12 col-sm-9">
        {!! $user->biography !!}
    <div>
</section>
<section class="row-fluid">
    <div class="col-xs-12 tabs">
        <ul>
            @if(!empty($user->badges) && Setting::show('badges'))
                <li><a href="#badges">Badges</a></li>
            @endif
            @if($user->supervisor !== NULL)
                <li><a href="#supervisors">Supervisor Chain</a></li>
            @endif
            @if($user->reports->count() !== 0)
                <li><a href="#reports">Reports</a></li>
            @endif
        </ul>
        @if(Setting::show('badges'))
            <div id="badges">
                @if($user->reports === NULL)
                    <h3>This person has no badges.</h3>
                @else
                        @foreach($user->badges as $badge)
                            <a href="{{ route('badges.show', ['badge' => $badge]) }}">
                                <img src="{{ $badge->photo->variant('profile')->url }}">
                            </a>
                        @endforeach
                @endif
            </div>
        @endif
        <div id="supervisors">
            @if($user->supervisor !== NULL)
                    @for(
                        $i = 0, $supervisor = $user->supervisor;
                        $supervisor !== NULL;
                        $supervisor = $supervisor->supervisor, $i++
                    )
                        <a href="{{ route('users.show', [$supervisor->id]) }}">
                            <img src="{{ $supervisor->photo->variant('profile')->url }}">
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
                            <img src="{{ $report->photo->variant('profile')->url }}">
                        </a>
                    @endforeach
            @endif
        </div>
    </div>
</section>
@endsection
