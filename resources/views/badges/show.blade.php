@extends('layouts.app')

@section('content')
<header class="row-fluid">
    <div>
        <h1 class="col-xs-12 center">{{ $badge->title }}</h1>
    </div>
</header>
<section class="row-fluid">
    <div class="col-xs-12 col-sm-6 offset-sm-3 center">
        <img src="{{ $badge->photo->variant('profile')->url }}">
    </div>
    <div class="col-xs-12 col-sm-6 offset-sm-3 ">
        {!! $badge->description !!}
    <div>
</section>
<footer>

</footer>
@endsection
