<div class="profile-dropdown__header">
    <div class="profile-dropdown__user">
        <a href="{{ action('UserController@getIndex', Auth::user()->getActionData()) }}">{{ Auth::user()->name }}</a>
    </div>
    <div class="profile-dropdown__tools">
        <a href="{{ action('Settings\SettingsController@getIndex') }}">
            {!! file_get_contents(public_path('assets/images/icons/settings.svg')) !!}Settings</a>
        <a href="{{ action('Auth\AuthController@getLogout') }}">
            {!! file_get_contents(public_path('assets/images/icons/logout.svg')) !!}Logout</a>
    </div>
</div>
<div class="profile-dropdown__notifications--empty">
    No new Notifications
</div>
