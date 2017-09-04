<div>
    <ul>
        @foreach($users as $user)
            <li>
                <h3>
                    <a href="{{route('admin.users.edit', ['user' => $user])}}">{{ $user->name }}</a>
                </h3>
                <span>{{ $user->position }}</span>
            </li>
        @endforeach
    </ul>
</div>
