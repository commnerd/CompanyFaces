<form method="POST" class="inline" action="{{ route('admin.users.destroy', ['user' => $user]) }}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="DELETE" />
    <a href="#delete" class="icon-remove"><i class="fa fa-times" area-hidden="true"></i></a>
</form>
