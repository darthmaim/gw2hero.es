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
				@include('auth.login.form-fields')
			{!! Form::close() !!}
		</div>
	</div>
@stop
