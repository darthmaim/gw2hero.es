@extends('settings.index')

@section('title', 'Settings (Accounts)')

@section('content.right')
    <h2>Accounts</h2>

    <a href="{{ action('Settings\AccountsController@getAdd') }}">+ Add account</a>

    <ul class="settings__accounts__list">
        @foreach($accounts as $acc)
            <li>
                <div class="settings__accounts__account__title">
                    <a href="{{ action('AccountController@getIndex', $acc->getActionData()) }}">
                        {{ $acc->getNameHtml() }}
                    </a>
                    <time class="settings__accounts__account__title__added"
                          datetime="{{ $acc->created_at }}" title="{{ $acc->created_at }}">
                        {{ $acc->created_at->diffForHumans() }}
                    </time>
                    @if(!$acc->api_key_valid)
                        <span style="color: red">Invalid API key!</span>
                    @endif
                </div>
                <div class="settings__accounts__account__content">
                    <dl class="settings__definition-list">
                        <dt>API key:</dt>
                        <dd class="settings__accounts__account__api-key" title="{{ $acc->api_key }}">{{ $acc->api_key }}</dd>
                    </dl>
                    <a href="{{ action('Settings\AccountsController@getEdit', [$acc->id]) }}">
                        @include('helper.icon', ['icon' => 'manage']) Edit</a>
                </div>
            </li>
        @endforeach
    </ul>

    <a href="{{ action('Settings\AccountsController@getAdd') }}">+ Add account</a>
@stop
