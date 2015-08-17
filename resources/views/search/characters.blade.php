@extends('search.results')

@section('content.right')
    <h2>Characters matching "{{ $searchTerm }}"</h2>
    <ul>
        @foreach($characters as $character)
            <li><a href={{ action('CharacterController@getIndex', $character->getActionData()) }}>
                    {{ $character->name }}
            </a></li>
        @endforeach
    </ul>
@endsection
