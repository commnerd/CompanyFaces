<form method="POST" class="inline" action="{{ route('admin.users.destroy', ['user' => $user]) }}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE" />
    <a href="#delete">delete</a>
</form>
