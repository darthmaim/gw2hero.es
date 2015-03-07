@extends('layout.wrapper')

@section('title')soon&trade;@stop

@section('styles')
<style>
	body {
		margin: 0;
		background: #f2f2f2 url("{{ asset('/images/background.png') }}");
		text-align: center;
	}
	img {
		max-width: 100%;
		height: auto;
	}
	#logo { margin-top: 200px; }
	#soon { margin-top: 100px; }
	@media( max-height: 700px ) {
		#logo { margin-top: 100px; }
		#soon { margin-top: 75px; }
	}
</style>
@stop

@section('content')
	<img id="logo" src="{{ asset('/images/logo.png') }}" width="500" height="300" alt="Guildwars2 Heroes"><br>
	<img id="soon" src="{{ asset('/images/soon.png') }}" width="120" height="65"  alt="soon&trade;">
@stop
