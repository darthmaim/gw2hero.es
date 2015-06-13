@extends('settings.layout')

@section('settings.content')
    <h3>Accounts</h3>

    <a href="{{ action('Settings\AccountsController@getAdd') }}">+ Add account</a>

    <ul class="settings__accounts__list">
        @foreach($accounts as $acc)
            <li>
                <div class="settings__accounts__account__title">
                    {!! $acc->getNameHtml() !!}
                </div>
                <div class="settings__accounts__account__content">
                    <dl class="settings--definition-list">
                        <dt>API key:</dt>
                        <dd class="settings__accounts__account__api-key">{{ $acc->api_key }}</dd>
                    </dl>
                </div>
            </li>
        @endforeach
    </ul>

    <a href="{{ action('Settings\AccountsController@getAdd') }}">+ Add account</a>
@stop
