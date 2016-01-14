@extends('layout.wrapper')

@section('title', 'Search'.(isset($searchTerm) ? ' '.e($searchTerm):''))

@section('content.left')
    <h2>Search Results</h2>

    @if(isset( $searchTerm ))
        @include('helper.sidebar-nav', ['links' => [
            'Characters ('.$characters->total().')'
                => action('SearchController@getIndex', ['q' => $searchTerm, 'tab' => 'characters']),
            'Accounts ('.$accounts->total().')'
                => action('SearchController@getIndex', ['q' => $searchTerm, 'tab' => 'accounts']),
            'Users ('.$users->total().')'
                => action('SearchController@getIndex', ['q' => $searchTerm, 'tab' => 'users'])
        ]])
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
