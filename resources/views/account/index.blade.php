@extends('layout.wrapper')

@section('title', e($account->name))

@section('content.left')
    <div class="char-info-box">
        <h2 class="char-info-box__name">{{ $account->name }}</h2>
        <div>
            Owned by <a href="{{ action('UserController@getIndex', $account->user->getActionData()) }}">
                {{ $account->user->name }}
            </a>
        </div>
    </div>

    @include('helper.sidebar-nav', ['links' => [
        'Summary' => action('AccountController@getIndex', $account->getActionData()),
        'Characters ('.$account->characters->count().')'
            => action('AccountController@getCharacters', $account->getActionData()),
        'Activities' => action('AccountController@getActivities', $account->getActionData()),
        'Guilds' => null,
        'Bank' => null,
        'Collections' => null
    ]])
@stop
