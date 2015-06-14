@extends('layout.wrapper')

@section('title', 'home')

@section('content.right')
    <h2>Settings</h2>

    @yield('settings.content')
@stop


@section('content.left')
    <div class="settings-sidebar">
        @section('settings.sidebar')
            <a href="{{ action('Settings\SettingsController@getProfile') }}">Profile</a>
            <a href="{{ action('Settings\AccountsController@getIndex') }}">Accounts</a>
            <a href="{{ action('Settings\SettingsController@getNotifications') }}">Emails and Notifications</a>
        @show
    </div>
@stop
