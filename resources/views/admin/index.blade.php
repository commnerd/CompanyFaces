@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <ul>
                <li>
                    <a href="{{route('adminIndex')}}">Add User</a>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>
@endsection