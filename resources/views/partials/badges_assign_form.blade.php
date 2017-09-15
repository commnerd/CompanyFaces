<form class="form-horizontal" role="form" method="POST" action="{{ $submissionRoute }}" enctype="multipart/form-data">
    @if(strtoupper($submissionMethod) !== 'POST')
        {{ method_field($submissionMethod) }}
    @endif
    {{ csrf_field() }}
    <input type="hidden" name="presentedBadges" value="{{ $presentedBadges }}" />
    @include('partials.badges_table', ['badges' => $badges, 'user' => $user, 'context' => 'form'])
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                {{ $submissionText }}
            </button>
        </div>
    </div>
</form>
