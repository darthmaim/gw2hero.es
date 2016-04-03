@extends('search.results')

@section('title', 'Search: '.e($searchTerm).' (Guilds)')

@section('content.right')
    <h2>Guilds matching "{{ $searchTerm }}"</h2>
    <ul>
        @foreach($guilds as $guild)
            <li><a href={{ action('GuildController@getIndex', $guild->getActionData()) }}>
                    {{ $guild->getNameHtml() }}
            </a></li>
        @endforeach
    </ul>
@endsection
