@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row-fluid">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create Badge</div>
                <div class="panel-body">
                    @include('partials.badge_form', [
                        'submissionRoute' => route('admin.badges.store'),
                        'submissionMethod' => 'POST',
                        'submissionText' => 'Create',
                        'badge' => new App\Badge
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
