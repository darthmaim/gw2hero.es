@extends('settings.index')

@section('title', 'Settings (Accounts)')

@section('content.right')
    <h2>Change API key of {{ $account->name }}</h2>

    @include('layout.form-errors')

    {!! Form::open(['action' => ['Settings\AccountsController@postEdit', $account->id]]) !!}
    {!! Form::hidden('api_key_name', $apiKeyName ) !!}

    <p>
        You can change your API key by going to your Guild Wars 2 account page.
        <a href="https://account.arena.net/applications/create" target="_blank">Create a new API Key</a>
        with the exact name <span class="api-key__name">{{ $apiKeyName }}</span> and with
        <span class="api-key__permission">account</span>, <span class="api-key__permission">characters</span>
        <span class="api-key__permission">unlocks</span> and <span class="api-key__permission">build</span> permissions.
    </p>

    <div class="form__field">
        {!! Form::label('api_key', 'Enter the new generated API key:') !!}
        {!! Form::text('api_key') !!}
    </div>

    <div class="form__field">
        {!! Form::submit('Change API key') !!}
    </div>

    {!! Form::close() !!}
@stop
