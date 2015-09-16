@extends('layout.wrapper')

@section('content.left')
    <div class="char-info-box">
        <h2 class="char-info-box__name">{{ $user->name }}</h2>
    </div>

    @include('helper.sidebar-nav', ['links' => [
        'Summary' => action('UserController@getIndex', $user->getActionData()),
        'Accounts' => action('UserController@getAccounts', $user->getActionData()),
        'Activities' => action('UserController@getActivities', $user->getActionData()),
    ]])
@stop
