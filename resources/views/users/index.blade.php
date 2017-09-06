<div>
    <ul>
        @foreach($users as $user)
            <li>
                <img <img src="{{ $user->photo->variant('search')->url }}" />
                <h3>
                    <a href="{{ route('users.show', [$user->id])}} ">{{ $user->name }}</a>
                </h3>
                <span>{{ $user->position }}</span>
            </li>
        @endforeach
    </ul>
</div>
