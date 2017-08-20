<div>
    <ul>
        @foreach($users as $user):
            <li>
                <h3>{{ $user->name }}</h3>
                <span>{{ $user->position }}</h3>
            </li>
        @endforeach
    </ul>
</div>
