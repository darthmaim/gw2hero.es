@extends('layout.wrapper')

@section('title', 'home')

@section('content')
	<h2>lang.home-header</h2>

	<div>
		You are logged in! <a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a>
	</div>

    <h3>Accounts</h3>
    <ul>
        @forelse($accounts as $acc)
            <li>
                @include('helper.accountName', [ 'account' => $acc ])
                <ul>
                    @forelse( $acc->characters as $char )
                        <li>{{ $char->name }} (Level {{ $char->level }} {{ $char->race }} {{ $char->profession }})</li>
                    @empty
                        <li>No characters</li>
                    @endforelse
                </ul>
            </li>
        @empty
            <li>
                No accounts added yet.
                <a href="{{ action('Settings\AccountsController@getAdd') }}">Add one now</a>.
            </li>
        @endforelse
    </ul>

    <a href="{{ action('Settings\AccountsController@getIndex') }}">Manage Accounts</a>
@stop
