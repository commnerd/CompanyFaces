@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row-fluid">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Badges for {{ $user->supervisorLabel }}</div>
                <div class="panel-body">
                    @include('partials.badges_assign_form', [
                        'submissionRoute' => route('admin.badges.save', ['user' => $user ]),
                        'submissionText' => 'Update',
                        'submissionMethod' => 'POST',
                        'badges' => $badges ?? []
                    ])
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
