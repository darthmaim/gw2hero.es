@extends('settings.layout')

@section('settings.content')
    <h3>Verify Account {!! $account->getNameHtml() !!}</h3>

    {!! Form::open([ 'action' => ['Settings\AccountsController@postVerify', $account->id] ]) !!}
        <p>
            Change the name of your API key to: <b>{{ $key }}</b>
        </p>
        {!! Form::submit('Verify Ownership') !!}

    {!! Form::close() !!}

@stop
