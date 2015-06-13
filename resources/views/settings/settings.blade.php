@extends('settings.layout')

@section('settings.content')
    <a href="{{ action('Settings\AccountsController@getIndex') }}">Manage Accounts</a>
@stop
