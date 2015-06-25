@extends('layout.wrapper')

@section('content.right')
    <h2>{{ $character->name }}</h2>
    Level {{ $character->level }} {{ $character->race }} {{ $character->profession }}
@stop
