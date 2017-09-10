@extends('layouts.app')

@section('content')
<div>
    <ul>
        @foreach($users as $user)
            <li class="list-container">
                <img src="{{ $user->photo->variant('search')->url }}" />
                <h3>
                    <a href="{{route('admin.users.edit', ['user' => $user])}}">{{ $user->name }}</a>
                </h3>
                <span>{{ $user->position }}</span>
                @include('partials.delete_link', ['user' => $user])
            </li>
        @endforeach
    </ul>
</div>
<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this user?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
