@extends('layout.wrapper')

@section('title', e($guild->name))

@section('content.left')
    <h2>{{ $guild->name }} <small>[{{ $guild->tag }}]</small></h2>

    @include('helper.sidebar-nav', [ 'links' => [
        'Summary' => action('GuildController@getIndex', $guild->getActionData())
    ]])
@stop
