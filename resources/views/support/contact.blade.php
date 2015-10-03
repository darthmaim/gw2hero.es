@extends('support.index')

@section('title', 'Contact')

@section('content.right')
    <h2>Contact</h2>

    <p>
        We can only help you with GW2Heroes related problems. If you have trouble with your Guild Wars 2 account,
        please contact the <a href="https://help.guildwars2.com/">Guild Wars 2 Support</a>.
    </p>

    @include('layout.form-errors')

    {!! Form::open(['action' => 'SupportController@postContact']) !!}
    <div class="form__field">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', old('name', (Auth::check() ? Auth::user()->name : ''))) !!}
    </div>
    <div class="form__field">
        {!! Form::label('email', 'Email') !!}
        {!! Form::email('email', old('email', (Auth::check() ? Auth::user()->email : ''))) !!}
    </div>
    <div class="form__field">
        {!! Form::label('subject', 'Subject') !!}
        {!! Form::text('subject', old('subject', request('subject')), ['class' => 'full-width']) !!}
    </div>
    <div class="form__field">
        {!! Form::label('body', 'Body') !!}
        {!! Form::textarea('body', old('body')) !!}
    </div>
    <p>
        Please provide us with as much essential information as possible.
    </p>
    <div class="form__field">
        {!! Form::submit('Contact Support') !!}
    </div>
    {!! Form::close() !!}
@stop
