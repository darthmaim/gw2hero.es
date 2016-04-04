@extends('layout.wrapper')

@section('title', 'Settings')

@section('content.left')
    <h2>Settings</h2>

    @include('helper.sidebar-nav', ['links' => [
        'Profile' => action('Settings\SettingsController@getProfile'),
        'Accounts' => action('Settings\AccountsController@getIndex'),
        'Emails and Notifications' => action('Settings\SettingsController@getNotifications')
    ]])
@stop
