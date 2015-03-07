@extends('layout.wrapper')

@section('title')
	<title>@lang('auth.register-header')</title>
@overwrite

@section('content')
	<div>
		<h2>@lang('auth.register-header')</h2>
		<div>
			@include('layout.form-errors')
		</div>
		<div>
			{!! Form::open() !!}
				<div>
					{!! Form::label('name', trans('auth.name')) !!}
					{!! Form::text('name', old('name'), ['placeholder' => trans('auth.name-placeholder')]) !!}
				</div>
				<div>
					{!! Form::label('email', trans('auth.email')) !!}
					{!! Form::email('email', old('email'), ['placeholder' => trans('auth.email-placeholder')]) !!}
				</div>
				<div>
					{!! Form::label('password', trans('auth.password')) !!}
					{!! Form::password('password') !!}
				</div>
				<div>
					{!! Form::label('password_confirmation', trans('auth.password-confirm')) !!}
					{!! Form::password('password_confirmation') !!}
				</div>

				<div>
					{!! Form::button(trans('auth.register-button'), ['type' => 'submit']) !!}
				</div>
				<div>
					<a href="{{ url('/auth/login') }}">@lang('auth.login-hint')</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop
