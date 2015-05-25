@extends('layout.wrapper')

@section('title', trans('auth.login.header'))

@section('content')
	<div>
		<h2>@lang('auth.login.header')</h2>
		<div>
			@include('layout.form-errors')
		</div>
		<div>
			{!! Form::open() !!}
				<div class="form__field">
					{!! Form::label('email', trans('auth.email.label')) !!}
					{!! Form::email('email', null, ['placeholder' => trans('auth.email.placeholder')]) !!}
				</div>
				<div class="form__field">
					{!! Form::label('password', trans('auth.password.label')) !!}
					{!! Form::password('password') !!}
				</div>
				<div class="form__field">
					<label for="remember">@lang('auth.login.remember') {!! Form::checkbox('remember') !!}</label>
				</div>
				<div class="form__field">
					{!! Form::button(trans('auth.login.button'), ['type' => 'submit']) !!}
				</div>
				<div class="form__field">
					<a href="{{ url('/password/email') }}">@lang('auth.password.hint')</a>
				</div>
				<div class="form__field">
					<a href="{{ url('/auth/register') }}">@lang('auth.register.hint')</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop
