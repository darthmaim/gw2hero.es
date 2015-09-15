@extends('layout.wrapper')

@section('title', 'home')

@section('content.right')
    <h2>Settings</h2>

    @yield('settings.content')
@stop


@section('content.left')
    @include('helper.sidebar-nav', ['links' => [
        'Profile' => action('Settings\SettingsController@getProfile'),
        'Accounts' => action('Settings\AccountsController@getIndex'),
        'Emails and Notifications' => action('Settings\SettingsController@getNotifications')
    ]])
@stop
