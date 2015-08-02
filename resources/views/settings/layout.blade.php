@extends('layout.wrapper')

@section('title', 'home')

@section('content.right')
    <h2>Settings</h2>

    @yield('settings.content')
@stop


@section('content.left')
    <ul class="sidebar-nav">
        @section('settings.sidebar')
            <li><a href="{{ action('Settings\SettingsController@getProfile') }}">Profile</a>
            <li><a href="{{ action('Settings\AccountsController@getIndex') }}">Accounts</a>
            <li><a href="{{ action('Settings\SettingsController@getNotifications') }}">Emails and Notifications</a>
        @show
    </ul>
@stop
