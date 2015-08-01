@extends('layout.email.html')

@section('title', 'Password reset')

@section('preheader')
    You requested a password reset.
@stop

@section('body')
    <p>Hello {{ $user->name }},</p>
    <p>
        Reset your password by clicking the button below:
    </p>
    <p>
        @include('layout.email.html.callToAction', ['href' => url('password/reset/'.$token), 'text' => 'Reset your password'])
    </p>
    <p>
        If you didn't request the password reset, you can ignore this email.
    </p>
    <p>
        In case you are still having trouble logging in,
        contact us at <a href="mailto:info@gw2hero.es">info@gw2hero.es</a>
        or on twitter <a href="https://twitter.com/gw2heroes">@gw2heroes</a>.
    </p>
    <p>
        Thank you,<br>GW2Heroes
    </p>
@stop
