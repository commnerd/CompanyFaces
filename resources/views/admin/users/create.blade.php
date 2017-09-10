@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row-fluid">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create</div>
                <div class="panel-body">
                    @include('partials.user_form', ['submissionRoute' => route('admin.users.store'), 'submissionMethod' => 'POST', 'submissionText' => 'Create', 'user' => null])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
