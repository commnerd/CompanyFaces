@extends('layouts.app')

@section('content')
<div style="position:absolute; top:0; bottom:0; left:0; right:0; z-index: -1;">
    @for($i = 0; $i < 60; $i++)
        <img src="http://lorempixel.com/110/110/people/{{$i % 11}}/cc" />
    @endfor
</div>
<div class="container">
    <form class="search-form" action="{{ route('search') }}" method="get">
        <div class="row-fluid">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Search</div>

                    <div class="panel-body">
                        <input text="text" name="terms" class="form-control" placeholder="Search" source="{{ route('search.users') }}" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
