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
            <a href="{{ action('AccountController@getIndex', $character->account->getActionData()) }}">
                {{ $character->account->getNameHtml() }}
            </a>
        </div>
    </div>

    <ul class="sidebar-nav">
        <li><a href="{{ action('CharacterController@getIndex', $character->getActionData()) }}">Summary</a>
        <li><a href="{{ action('CharacterController@getStory', $character->getActionData()) }}">Story</a>
        <li><a href="{{ action('CharacterController@getActivities', $character->getActionData()) }}">Activities</a>
        <li><a href="">Gallery</a>
        <li><a href="{{ action('CharacterController@getEquipment', $character->getActionData()) }}">Equipment & Inventory</a>
        <li><a href="">Crafting Disciplines</a>
    </ul>
@stop
