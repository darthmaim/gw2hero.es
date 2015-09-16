@extends('search.results')

@section('content.right')
    <h2>Users matching "{{ $searchTerm }}"</h2>
    <ul>
        @foreach($users as $user)
            <li><a href="{{ action('UserController@getIndex', $user->getActionData()) }}">
                {{ $user->name }}
            </a></li>
        @endforeach
    </ul>
@endsection
