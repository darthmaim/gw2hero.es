@extends('search.results')

@section('title', 'Search: '.e($searchTerm).' (Characters)')

@section('content.right')
    <h2>Characters matching "{{ $searchTerm }}"</h2>
    <ul class="list-fullwidth search-results search-results--character">
        @foreach($characters as $character)
            <li>
                <a class="character" href={{ action('CharacterController@getIndex', $character->getActionData()) }}>
                    {{ $character->name }}
                    <span class="character-info">
                        <b>{{ $character->level }}</b> {{ $character->race }} {{ $character->profession }}
                    </span>
                </a>
                <span class="account">
                    <a href={{ action('AccountController@getIndex', $character->account->getActionData()) }}>
                        {{ $character->account->getNameHtml() }}
                    </a>
                </span>
            </li>
        @endforeach
    </ul>

    {!! $characters !!}
@endsection
