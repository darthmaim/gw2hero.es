@extends('layout.wrapper')

@section('content')
    <h2>Search</h2>

    {!! Form::open(['action' => 'SearchController@getIndex', 'method' => 'GET']) !!}
        {!! Form::input('text', 'q') !!}
        {!! Form::submit('Search') !!}
    {!! Form::close() !!}
@endsection
