@extends('layout.wrapper')

@section('title')
	<title>@lang('auth.password.header')</title>
@overwrite

@section('content')
	<div>
		<h2>@lang('auth.password.header')</h2>
		<div>
			@include('layout.form-errors')
		</div>
		<div>
			{!! Form::open() !!}
				{!! Form::hidden('token', $token) !!}
			<div>
				{!! Form::label('email', trans('auth.email.label')) !!}
				{!! Form::email('email', old('email'), ['placeholder' => trans('auth.email.placeholder')]) !!}
			</div>
			<div>
				{!! Form::label('password', trans('auth.password.label')) !!}
				{!! Form::password('password') !!}
			</div>
			<div>
				{!! Form::label('password_confirmation', trans('auth.password.confirm')) !!}
				{!! Form::password('password_confirmation') !!}
			</div>
			<div>
				{!! Form::button(trans('auth.password.button'), ['type' => 'submit']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop
