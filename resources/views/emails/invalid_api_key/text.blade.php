@extends('layout.email.text')

@section('body')
Hello {{ $account->user->name }},

The API key used by your account "{{ $account->name }}" is invalid. A possible cause for this is that your recently deleted this key.

To always show up-to-date information about your account on gw2hero.es, we need a valid API key. Please update your API key in your account settings.

    {{ action('Settings\AccountsController@getEdit', [$account->id]) }}

Thank you,
GW2Heroes
@stop
