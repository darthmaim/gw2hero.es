@extends('layout.email')

@section('title')
	<title>@lang('mail.password-reset-subject')</title>
@overwrite

@section('preheader')
	@lang('mail.password-reset-subject')
@stop

@section('body')
	<p>{{ sprintf(trans('mail.password-reset-body'), e('user.name')) }}</p>

	<a href="{{ url('password/reset/'.$token) }}">@lang('mail.password-reset-link')</a>
@stop

@section('footer')
	@include('layout.efooter')
@stop