@extends('layout.wrapper')

@section('title', 'Admin')

@section('content.left')
    <h2>Admin</h2>

   @include('helper.sidebar-nav', ['links' => [
        'Dashboard' =>  action('AdminController@getIndex'),
        'Users' => action('AdminController@getUsers'),
        'Accounts' => action('AdminController@getAccounts'),
    ]])
@stop
