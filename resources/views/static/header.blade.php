<nav id="header" class="header" role="banner">
    <div class="header__content">
        <div class="header__left">
            @section('header.left')
                <a class="header__button">Characters</a>
                <a class="header__button">Guilds</a>
            @show
        </div>
        <div class="header__center">
            <a class="header__logo" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/header.svg') }}" width="100" height="48" alt="gw2hero.es">
            </a>
        </div>
        <div class="header__right">
            @section('header.right')
                <a class="header__button">Search</a>
                @if(Auth::check())
                    <div class="header__button--dropdown" tabindex="0">
                        <a class="header__button--dropdown__link">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="header__button__dropdown">
                            <a href="/settings">Settings</a>
                        </div>
                    </div>
                @else
                    <div class="header__button--dropdown" tabindex="0">
                        <a class="header__button--dropdown__link" href="{{ action('Auth\AuthController@getLogin') }}">
                            Login
                        </a>
                        <div class="header__button__dropdown">
                            {!! Form::open(['url' => action('Auth\AuthController@postLogin')]) !!}
                                @include('auth.login.form-fields')
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            @show
        </div>
    </div>
</nav>
