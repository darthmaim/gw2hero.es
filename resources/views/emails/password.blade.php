@extends('layout.email')

@section('title')
	<title>@lang('mail.password.subject')</title>
@overwrite

@section('preheader')
	@lang('mail.password.subject')
@stop

@section('body')
	<p>@lang('mail.password.body')</p>

	<a href="{{ url('password/reset/'.$token) }}">@lang('mail.password.link')</a>
@stop

@section('footer')
	@include('layout.email-footer')
@stop