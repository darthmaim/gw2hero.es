@extends('layout.wrapper')

@section('title', 'GW2Heroes &bull; Tell your story')

@section('class', 'body--red')

@section('wrapper')
    <div class="wrapper" id="wrapper" role="main">
        <div class="teaser">
            <img src="{{ asset2('images/teaser.svg') }}" width="1000" height="500">
        </div>
        <div class="content">
            @section('content')
                <section class="welcome-section--left">
                    <div class="welcome-section__content">
                        <h2>Tell Your Story</h2>

                        <p>
                            Write stories about the adventures of your characters in Tyria and
                            share them with other players.
                        </p>

                        <p>
                            Showcase your unique achievements, statistics, equipment, specializations and more and
                            compare them with your friends and guildmates.
                        </p>

                        <p class="welcome-button">
                            <a class="input--button" href="{{ action('Auth\AuthController@getRegister') }}">Register now</a>
                        </p>
                    </div>
                    <div class="welcome-section__image"
                         style="background-image: url({{ asset2('images/welcome/welcome1.jpg') }})"></div>
                </section>
                <section class="welcome-section--right welcome-section--dark">
                    <div class="welcome-section__content">
                        <h2>Stay Connected</h2>

                        <p>
                            Follow other heroes of Tyria and chat with them about their accomplishments.
                            Never miss what your friends are doing.
                        </p>

                        <p class="welcome-stats">
                            Join the community of <span><em>{{ $userCount }}</em> users</span>
                            with <span><em>{{ $characterCount }}</em> characters</span>
                            on <span><em>{{ $accountCount }}</em> accounts</span>.
                        </p>

                        <p class="welcome-button">
                            <a class="input--button" href="{{ action('Auth\AuthController@getRegister') }}">Register now</a>
                        </p>
                    </div>
                    <div class="welcome-section__image"
                         style="background-image: url({{ asset2('images/welcome/welcome2.jpg') }})"></div>
                </section>
            @show
        </div>
    </div>
@stop
