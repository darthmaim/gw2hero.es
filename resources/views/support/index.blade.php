@extends('layout.wrapper')

@section('title', 'Support')

@section('content.left')
    <h2>Support</h2>

    @include('helper.sidebar-nav', ['links' => [
        'Contact' => action('SupportController@getContact'),
        'About' => action('SupportController@getAbout'),
        'Terms of Service' => action('SupportController@getTerms'),
        'Privacy Policy' => action('SupportController@getPrivacy'),
        'Impressum' => action('SupportController@getImpressum'),
    ]])
@endsection
