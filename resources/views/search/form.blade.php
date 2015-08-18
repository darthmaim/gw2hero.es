{!! Form::open(['action' => 'SearchController@getIndex', 'method' => 'GET', 'class' => 'form--flex']) !!}
    {!! Form::input('text', 'q', isset( $searchTerm ) ? $searchTerm : null) !!}
    {!! Form::submit('Search') !!}
{!! Form::close() !!}
