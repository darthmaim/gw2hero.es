@extends('layout.email.text')

@section('title', '[Support Request] '.$subject)

@section('body')
Name: {{ $name }}
Email: {{ $email }}
Subject: {{ $subject }}
Body:
{{ $body }}

---

IP: {{ $ip }}
UA: {{ $ua }}
User ID: {{ $userId }}
@stop
