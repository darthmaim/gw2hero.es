@extends('layout.wrapper')

@section('title')
	<title>@lang('auth.password.header')</title>
@overwrite

@section('content')
	<div>
		<h2>@lang('auth.password.header')</h2>
		<div>
			@if(session('status'))
				<div>
					{{ session('status') }}
				</div>
			@endif

			@include('layout.form-errors')
		</div>
		<div>
			{!! Form::open() !!}
				<div>
					{!! Form::label('email', trans('auth.email.label')) !!}
					{!! Form::email('email', old('email'), ['placeholder' => trans('auth.email.placeholder')]) !!}
				</div>
				<div>
					{!! Form::button(trans('auth.password.mail-button'), ['type' => 'submit']) !!}
				</div>
				<div>
					<a href="{{ url('/auth/login') }}">@lang('auth.login.hint')</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop
