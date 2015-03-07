@extends('layout.wrapper')

@section('title')
<title>@lang('auth.login-header')</title>
@overwrite

@section('content')
	<div>
		<h2>@lang('auth.login-header')</h2>
		<div>
			@include('layout.form-errors')
		</div>
		<div>
			{!! Form::open() !!}
				<div>
					{!! Form::label('email', trans('auth.email')) !!}
					{!! Form::email('email', null, ['placeholder' => trans('auth.email-placeholder')]) !!}
				</div>
				<div>
					{!! Form::label('password', trans('auth.password')) !!}
					{!! Form::password('password') !!}
				</div>
				<div>
					<label for="remember">@lang('auth.remember-login') {!! Form::checkbox('remember') !!}</label>
				</div>
				<div>
					{!! Form::button(trans('auth.login-button'), ['type' => 'submit']) !!}
				</div>
				<div>
					<a href="{{ url('/password/email') }}">@lang('auth.password-reset-hint')</a>
				</div>
				<div>
					<a href="{{ url('/auth/register') }}">@lang('auth.register-hint')</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop
