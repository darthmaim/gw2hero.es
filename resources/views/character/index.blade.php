@extends('layout.wrapper')

@section('title', e($character->name))

@section('content.left')
    <div class="char-info-box">
        <h2 class="char-info-box__name">{{ $character->name }}</h2>
        <div class="char-info-box__char">
            <span class="level">{{ $character->level }}</span>
            <span class="race">{{ $character->race }}</span>
            <span class="profession">{{ $character->profession }}</span>
        </div>
        @if($character->guild !== null)
            <div class="char-info-box__guild">
                <a href="{{ action('GuildController@getIndex', $character->guild->getActionData()) }}">{{ $character->guild->getNameHtml() }}</a>
            </div>
        @endif
        <div class="char-info-box__owner">
            <a href="{{ action('AccountController@getIndex', $character->account->getActionData()) }}">
                {{ $character->account->getNameHtml() }}
            </a>
        </div>
    </div>

    @include('helper.sidebar-nav', [ 'links' => [
        'Summary' => action('CharacterController@getIndex', $character->getActionData()),
        'Story' => action('CharacterController@getStory', $character->getActionData()),
        'Activities' => action('CharacterController@getActivities', $character->getActionData()),
        'Gallery' => null,
        'Equipment' => action('CharacterController@getEquipment', $character->getActionData()),
        'Specializations' => action('CharacterController@getSpecializations', $character->getActionData()),
        'Crafting Disciplines' => null,
    ]])
@stop
