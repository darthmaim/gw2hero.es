@extends('settings.layout')

@section('settings.content')
    <h3>Add account</h3>

    @foreach($errors->all() as $error)
        <div style="color:red">{{ $error }}</div>
    @endforeach

    {!! Form::open(['action' => 'Settings\AccountsController@postAdd']) !!}
    {!! Form::hidden('api_key_name', $apiKeyName ) !!}

    <p>
        Go to your Guild Wars 2 account page to
        <a href="https://account.guildwars2.com/account/api-keys/create" target="_blank">create a new API Key</a>
        with the exact name <span class="api-key__name">{{ $apiKeyName }}</span> and with
        <span class="api-key__permission">account</span> and
        <span class="api-key__permission">characters</span> permissions.
    </p>

    <div class="form__field">
        {!! Form::label('Enter the generated API key:') !!}
        {!! Form::text('api_key') !!}
    </div>

    <div class="form__field">
        {!! Form::submit('Add account') !!}
    </div>

    {!! Form::close() !!}
@stop
