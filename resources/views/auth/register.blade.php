@extends('layout.wrapper')

@section('title', trans('auth.register.header'))

@section('content')
	<div>
		<h2>@lang('auth.register.header')</h2>
		<div>
			@include('layout.form-errors')
		</div>
		<div>
			{!! Form::open() !!}
				<div class="form__field">
					{!! Form::label('name', trans('auth.name.label')) !!}
					{!! Form::text('name', old('name'), ['placeholder' => trans('auth.name.placeholder')]) !!}
				</div>
				<div class="form__field">
					{!! Form::label('email', trans('auth.email.label')) !!}
					{!! Form::email('email', old('email'), ['placeholder' => trans('auth.email.placeholder')]) !!}
				</div>
				<div class="form__field">
					{!! Form::label('password', trans('auth.password.label')) !!}
					{!! Form::password('password') !!}
				</div>
				<div class="form__field">
					{!! Form::label('password_confirmation', trans('auth.password.confirm')) !!}
					{!! Form::password('password_confirmation') !!}
				</div>
				<div class="form__field">
					<label>
						{!! Form::checkbox('accept_terms') !!}
						I accept the <a href="{{ action('SupportController@getTerms') }}">Terms of Service</a>
						and the <a href="{{ action('SupportController@getPrivacy') }}">Privacy Policy</a>.
					</label>
				</div>

				<div class="form__field">
					{!! Form::button(trans('auth.register.button'), ['type' => 'submit']) !!}
				</div>
				<div class="form__field">
					<a href="{{ url('/auth/login') }}">@lang('auth.login.hint')</a>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop
