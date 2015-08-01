@extends('layout.email.html')

@section('preheader')
    Please update your API key in your account settings.
@stop

@section('body')
    <p>Hello {{ $account->user->name }},</p>
    <p>
        The API key used by your account <b>{{ $account->name }}</b> is invalid. A possible cause for this is
        that your recently deleted this key.
    </p>
    <p>
        To always show up-to-date information about your account on gw2hero.es, we need a valid API key. Please
        <a href="{{ action('Settings\AccountsController@getEdit', [$account->id]) }}">update your API key</a>
        in your account settings.
    </p>
    <p>
        Thank you,<br>GW2Heroes
    </p>
@stop
