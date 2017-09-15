<div class="col-xs-12 table-responsive">
    {{ $badges->links() }}
    <table class="table table-striped table-badges">
        <thead>
            <tr>
                <th>
                    Photo
                </th>
                <th>
                    Title
                </th>
                @if(Auth::user() && Auth::user()->superuser)
                <th class="center">
                    Actions
                </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($badges as $badge)
                <tr class="list-container">
                    <td>
                        <img src="{{ $badge->photo->variant('mini')->url }}" />
                    </td>
                    <td>
                        <a href="{{route('badges.show', ['badge' => $badge])}}">{{ $badge->title }}</a>
                    </td>
                    @if(Auth::user() && Auth::user()->superuser)
                    <td class="actions center">
                        <a href="{{ route('admin.badges.edit', ['badge' => $badge]) }}" aria-hidden="true" class="fa fa-pencil-square-o fa-2x"></a>
                        @include('partials.delete_link', ['context' => 'badges', 'entity' => $badge])
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $badges->links() }}
</div>
