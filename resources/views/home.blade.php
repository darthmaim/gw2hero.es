@extends('layout.wrapper')

@section('title')
	<title>lang.home-header</title>
@overwrite

@section('content')
	<h2>lang.home-header</h2>

	<div>
		You are logged in! <a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a>
	</div>

    <h3>Accounts</h3>
    <ul>
        @forelse($accounts as $acc)
            <li>
                @include('helper.accountName', [ 'accountName' => $acc->name ])
                <ul>
                    @forelse( $acc->characters as $char )
                        <li>{{ $char->name }} (Level {{ $char->level }} {{ $char->race }} {{ $char->profession }})</li>
                    @empty
                        <li>No characters</li>
                    @endforelse
                </ul>
            </li>
        @empty
            <li>No accounts added yet.</li>
        @endforelse
    </ul>

    {!! Form::open([ 'action' => 'HomeController@addAccount' ]) !!}
        <div class="form__field">
            {!! Form::label('api_key', 'Api key') !!}
            {!! Form::text('api_key') !!}
        </div>
        <div class="form__field">
            {!! Form::submit('Add account') !!}
        </div>
    {!! Form::close() !!}
@stop
