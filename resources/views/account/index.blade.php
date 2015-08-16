@extends('layout.wrapper')

@section('content.left')
    <div class="char-info-box">
        <h2 class="char-info-box__name">{{ $account->name }}</h2>
        <div>
            Owned by <a>{{ $account->user->name }}</a>
        </div>
    </div>

    <ul class="sidebar-nav">
        <li><a href="{{ action('AccountController@getIndex', $account->getActionData()) }}">Summary</a>
        <li><a href="">Characters ({{ $account->characters->count() }})</a>
        <li><a href="">Activities</a>
        <li><a href="">Guilds</a>
        <li><a href="">Bank</a>
        <li><a href="">Collections</a>
    </ul>
@stop
