@extends('layout.wrapper')

@section('title')
	<title>lang.home-header</title>
@overwrite

@section('content')
	<h2>lang.home-header</h2>

	<div>
		You are logged in! <a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a>
	</div>
@stop
