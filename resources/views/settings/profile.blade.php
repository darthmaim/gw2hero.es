@extends('settings.layout')

@section('settings.content')
    <b>Username</b>: {{ Auth::user()->name }}

    <br>
    <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim( Auth::user()->email ))) }}?d=identicon" />
@endsection
