<div class="profile-dropdown__header">
    <div class="profile-dropdown__user">
        <a href="{{ action('UserController@getIndex', Auth::user()->getActionData()) }}">{{ Auth::user()->name }}</a>
    </div>
    <div class="profile-dropdown__tools">
        <a href="{{ action('Settings\SettingsController@getIndex') }}">
            @include('helper.icon', ['icon' => 'settings'])Settings</a>
        <a href="{{ action('Auth\AuthController@getLogout') }}">
            @include('helper.icon', ['icon' => 'logout'])Logout</a>
    </div>
</div>
<div class="profile-dropdown__notifications--empty">
    No new Notifications
</div>
