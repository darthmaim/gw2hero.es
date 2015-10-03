@extends('layout.wrapper')

@section('content.left')
    @include('helper.sidebar-nav', ['links' => [
        'Contact' => action('SupportController@getContact'),
        'About' => null,
        'Terms of Service' => null,
        'Privacy' => null,
        'Impressum' => null,
    ]])
@endsection
