@extends('layout.email.text')

@section('title', 'Password reset')

@section('body')
Hello {{ $user->name }},

Reset your password by following the link below:

    {{ url('password/reset/'.$token) }}

If you didn't request the password reset, you can ignore this email.

In case you are still having trouble logging in, contact us at info@gw2hero.es or on twitter @gw2heroes <https://twitter.com/gw2heroes>.

Thank you,
GW2Heroes
@stop
