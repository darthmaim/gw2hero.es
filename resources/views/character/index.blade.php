@extends('layout.wrapper')

@section('content.left')
    <div class="char-info-box">
        <h2 class="char-info-box__name">{{ $character->name }}</h2>
        <div class="char-info-box__char">
            <span class="level">{{ $character->level }}</span>
            <span class="race">{{ $character->race }}</span>
            <span class="profession">{{ $character->profession }}</span>
        </div>
        <div class="char-info-box__guild">
            Member of <a>Some Guild [some]</a>
        </div>
        <div class="char-info-box__owner">
            <a>{{ $character->account->user->name }}</a> &raquo; <a>{{ $character->account->getNameHtml() }}</a>
        </div>
    </div>

    <ul class="sidebar-nav">
        <li><a href="{{ action('CharacterController@getIndex', $character->getActionData()) }}">Summary</a>
        <li><a href="">Story</a>
        <li><a href="{{ action('CharacterController@getActivities', $character->getActionData()) }}">Activities</a>
        <li><a href="">Gallery</a>
        <li><a href="">Equipment & Inventory</a>
        <li><a href="">Crafting Disciplines</a>
    </ul>
@stop
