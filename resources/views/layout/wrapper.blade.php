<!DOCTYPE html>
<!--[if lt IE 7]>      <html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="{{ App::getLocale() }}" itemscope itemtype="http://schema.org/WebSite" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="{{ App::getLocale() }}" itemscope itemtype="http://schema.org/WebSite" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="{{ App::getLocale() }}" itemscope itemtype="http://schema.org/WebSite" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="{{ App::getLocale() }}" itemscope itemtype="http://schema.org/WebSite" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8" />
    <title>@yield('title', 'gw2hero.es')</title>

	@section('keywords')
	    <meta name="keywords" content="" />
	@show

	@section('author')
	    <meta name="author" content="gw2hero.es" />
	@show

	@section('description')
	    <meta name="description" content="gw2hero.es" />
	@show

	<meta name="robots" content="index,follow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#B7000D">

	<link rel="shortcut icon" href="{{ url('favicon.ico') }}" />
    <link rel="icon" sizes="192x192" type="img/png" href="{{ asset2('images/favicon-192x192.png') }}">
	<link rel="manifest" href="manifest.json">

	<link rel="stylesheet" href="{{ asset2('css/normalize.css') }}" />
	<link rel="stylesheet" href="{{ asset2('css/gw2heroes.css') }}" />
    <link href='https://fonts.googleapis.com/css?family=Bitter:700|Roboto:700,400' rel='stylesheet' type='text/css'>

	@yield('styles')
</head>
<body class="@yield('class', '')">
    @include('static.header')
    @include('static.content')
    @include('static.footer')
    @include('static.scripts')
</body>
</html>
