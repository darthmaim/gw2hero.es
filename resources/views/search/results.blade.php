@extends('layout.wrapper')

@section('content.left')
    <h2>Search Results</h2>

    @if(isset( $searchTerm ))
        <ul class="sidebar-nav">
            <li><a href="{{ action('SearchController@getIndex', ['q' => $searchTerm, 'tab' => 'characters']) }}">
                Characters ({{ $characters->count() }})
            </a>
            <li><a href="{{ action('SearchController@getIndex', ['q' => $searchTerm, 'tab' => 'accounts']) }}">
                Accounts ({{ $accounts->count() }})
            </a>
            <li><a href="{{ action('SearchController@getIndex', ['q' => $searchTerm, 'tab' => 'users']) }}">
                Users ({{ $users->count() }})
            </a>
        </ul>
    @endif
@endsection

@section('wrapper')
    <div class="wrapper wrapper--search">
        <div class="content">
            @include('search.form')
        </div>
    </div>
    @parent
@endsection
