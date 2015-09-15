@extends('layout.wrapper')

@section('content.left')
    <h2>Search Results</h2>

    @if(isset( $searchTerm ))
        @include('helper.sidebar-nav', ['links' => [
            'Characters ('.$characters->count().')'
                => action('SearchController@getIndex', ['q' => $searchTerm, 'tab' => 'characters']),
            'Accounts ('.$accounts->count().')'
                => action('SearchController@getIndex', ['q' => $searchTerm, 'tab' => 'accounts']),
            'Users ('.$users->count().')'
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
