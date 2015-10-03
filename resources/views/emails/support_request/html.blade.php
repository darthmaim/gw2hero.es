@extends('layout.email.html')

@section('title', '[Support Request] '.$subject)

@section('preheader')
    New support request: {{ $subject }}
@stop

@section('body')
    <b>Name:</b> {{ $name }}<br>
    <b>Email:</b> {{ $email }}<br>
    <b>Subject:</b> {{ $subject }}<br>
    <b>Body:</b><br>
    {!! str_replace("\n", "<br>", e($body)) !!}

    <div style="color: #888; border-top: 1px solid #eee; margin-top: 1em; padding-top: 1em;">
        <b>IP:</b> {{ $ip }}<br>
        <b>UA:</b> {{ $ua }}<br>
        <b>User ID:</b> {{ $userId }}
    </div>
@stop
