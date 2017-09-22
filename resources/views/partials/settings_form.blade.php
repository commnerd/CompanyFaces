<form class="form-horizontal" role="form" method="POST" action="{{ route('admin.settings.store') }}">
    {{ csrf_field() }}
    <fieldset>
        <legend>Settings</legend>
        <ul>
            @foreach($settings as $setting)
            <li>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="{{ $setting->slug }}" {{ $setting->enabled ? 'checked' : '' }}> {{ $setting->label }}
                    </label>
                </div>
            </li>
            @endforeach
        </ul>
        <input class="btn" type="submit" />
    </fieldset>
</form>
