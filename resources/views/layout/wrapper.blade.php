<!DOCTYPE html>
<html dir="ltr" lang="{{ App::getLocale() }}" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8" />
	@section('title')
	<title>Pagetitle &bull; gw2hero.es</title>
	@show
	@section('keywords')
	<meta name="keywords" content="" />
	@show
	@section('author')
	<meta name="author" content="gw2hero.es" />
	@show
	@section('description')
	<meta name="description" content="gw2hero.es" />
	@show
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="robots" content="index,follow" />
	<meta name="google-site-verification" content="{{ env('GOOGLE_WEBMASTERTOOLS', '') }}" />
	<link rel="shortcut icon" type="image/png" href="{{ asset('/assets/images/favicon.png') }}" />
	<link rel="stylesheet" href="{{ asset('/assets/css/normalize.css') }}" />
	<link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}" />
	@yield('styles')
</head>
<body>
<!-- overlay -->
<div class="body noprint hidden" id="overlay"></div>
<!-- header/banner -->
<header class="body" id="overall-header" role="banner">
@yield('header')
</header>
<!-- main navigation -->
<div class="body noprint" id="site-navigation">
	<!-- menu -->
	<nav id="main-menu" role="navigation">
	@yield('menu')
	</nav>
</div>
<!-- content wrapper -->
<div class="body" id="wrapper" role="main">
@yield('content')
</div>
<!-- overall footer -->
<footer class="body noprint" id="overall-footer" role="contentinfo">
@yield('footer')
</footer>
<!-- get all the magick done :o -->
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/prototype/1.7.2/prototype.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/scriptaculous/1.9.0/scriptaculous.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>var $J = jQuery.noConflict();</script>
-->
<script async src="{{ asset('/assets/js/gw2heroes.js') }}"></script>
@yield('scripts')
<script async>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', '{{ env('GOOGLE_ANALYTICS', '') }}', 'auto');
	ga('set', 'anonymizeIp', true);
	ga('send', 'pageview');
</script>
</body>
<!-- KTHXBYE! -->
</html>
