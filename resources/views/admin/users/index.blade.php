@extends('layouts.app')

@section('content')
<h1 class="col-xs-12">Users <a href="{{ route('admin.users.create') }}"><i class="fa fa-plus"></i></a></h1>
<div class="col-xs-12 table-responsive">
    <table class="table table-striped table-users">
        <thead>
            <tr>
                <th>
                    Photo
                </th>
                <th>
                    Name (Position)
                </th>
                <th class="center">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="list-container">
                    <td>
                        <img src="{{ $user->photo->variant('mini')->url }}" />
                    </td>
                    <td>
                        <a href="{{route('admin.users.edit', ['user' => $user])}}">{{ $user->supervisorLabel }}</a>
                    </td>
                    <td class="actions center">
                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}" class="fa fa-pencil-square-o"></a>
                        @include('partials.delete_link', ['user' => $user])
                    </td>
                </tr>
            @endforeach
        </tbody>
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
