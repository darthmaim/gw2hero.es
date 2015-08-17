@extends('search.results')

@section('content.right')
    <h2>Users matching "{{ $searchTerm }}"</h2>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>
@endsection
