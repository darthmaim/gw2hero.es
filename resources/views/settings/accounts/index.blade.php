@extends('settings.layout')

@section('settings.content')
    <h3>Accounts</h3>

    <ul class="settings__accounts__list">
        @foreach($accounts as $acc)
            <li id="account-{{ $acc->id }}">
                <div class="settings__accounts__account__title">
                    <a href="#account-{{ $acc->id }}">
                        {!! $acc->getNameHtml() !!}
                    </a>
                </div>
                @unless( $acc->api_key_verified )
                    <div class="settings__accounts__account__api-key__not-verified">
                        You have to verify the ownership of this account before you can use it.
                        <a href="{{ action('Settings\AccountsController@getVerify', $acc->id) }}">Verify Ownership</a>.
                    </div>
                @endunless
                <div class="settings__accounts__account__content">
                    <dl class="settings--definition-list">
                        <dt>API key:</dt>
                        <dd class="settings__accounts__account__api-key">{{ $acc->api_key }}</dd>
                    </dl>
                </div>
            </li>
        @endforeach
    </ul>
@stop
