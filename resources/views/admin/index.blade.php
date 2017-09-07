@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row-fluid">
        <div class="col-md-6">
            <ul>
                <li>
                    <a href="{{ route('admin.users.index') }}">Users</a>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
        </div>
    </div>
</div>
@endsection
