<div class="col-xs-12 table-responsive">
    {{ $users->links() }}
    <table class="table table-striped table-users">
        <thead>
            <tr>
                <th>
                    Photo
                </th>
                <th>
                    Name (Position)
                </th>
                @if(Auth::user() && Auth::user()->superuser)
                <th class="center">
                    Actions
                </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr class="list-container">
                    <td>
                        <img src="{{ $user->photo->variant('mini')->url }}" />
                    </td>
                    <td>
                        <a href="{{route('users.show', ['user' => $user])}}">{{ $user->supervisorLabel }}</a>
                    </td>
                    @if(Auth::user() && Auth::user()->superuser)
                    <td class="actions center">
                        <a href="{{ route('admin.users.edit', ['user' => $user]) }}" class="fa fa-pencil-square-o fa-2x"></a>
                        @include('partials.delete_link', ['context' => 'users', 'entity' => $user])
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
