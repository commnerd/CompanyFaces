@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row-fluid">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    @include('partials.user_form', [
                        'submissionText' => 'Register',
                        'submissionRoute' => route('register'),
                        'submissionMethod' => 'POST',
                        'user' => new App\User
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
