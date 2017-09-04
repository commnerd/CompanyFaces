@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row-fluid">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit {{ $user->name }} ({{ $user->position }})</div>
                <div class="panel-body">
                    @include('partials.user_form', ['submissionRoute' => route('admin.users.update', $user->id), 'submissionText' => 'Update', 'user' => $user, ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
