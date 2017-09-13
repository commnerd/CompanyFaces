@extends('layouts.app')

@section('content')

<h1>Search Results</h1>
@include('partials.users_table', ['users' => $users])

@endsection
