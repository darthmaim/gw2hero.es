@extends('layout.wrapper')

@section('title', 'Support')

@section('content.left')
    @include('helper.sidebar-nav', ['links' => [
        'Contact' => action('SupportController@getContact'),
        'About' => null,
        'Terms of Service' => null,
        'Privacy' => null,
        'Impressum' => null,
    ]])
@endsection
