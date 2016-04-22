@extends('settings.index')

@section('title', 'Settings (Accounts)')

@section('content.right')
    <h2>Add account</h2>

    @include('layout.form-errors')

    <p>
        Go to your Guild Wars 2 account page to
        <a href="https://account.arena.net/applications/create" target="_blank">create a new API Key</a>
        with the exact name <span class="api-key__name">{{ $apiKeyName }}</span> and with
        <span class="api-key__permission">account</span>, <span class="api-key__permission">characters</span>,
        <span class="api-key__permission">unlocks</span> and <span class="api-key__permission">build</span> permissions.
    </p>


    {!! Form::open(['action' => 'Settings\AccountsController@postAdd']) !!}
    {!! Form::hidden('api_key_name', $apiKeyName ) !!}

    <div class="form__field">
        {!! Form::label('api_key', 'Enter the generated API key:') !!}
        {!! Form::text('api_key') !!}
    </div>

    <div class="form__field">
        {!! Form::submit('Add account') !!}
    </div>

    {!! Form::close() !!}

    <h3></h3>
@stop
