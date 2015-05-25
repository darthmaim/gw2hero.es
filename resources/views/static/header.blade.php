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
                    <a class="header__button">{{ Auth::user()->name }}</a>
                @else
                    <a class="header__button" href="{{ action('Auth\AuthController@getLogin') }}">Login</a>
                @endif
            @show
        </div>
    </div>
</nav>
