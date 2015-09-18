@extends('layout.wrapper')

@section('title', 'home')

@section('content.right')
	<h2>Home</h2>

    @if(Session::has('new_account'))
        <?php $firstChar = Session::get('new_account')->characters()->orderBy('age', 'desc')->first() ?>
        <p>
            Great! You just added your first account. Now you can write about your characters adventures,
            upload some pictures and share them with everyone.
            @if(!is_null($firstChar))
                Why don't you start with
                <a href="{{ action('CharacterController@getIndex', $firstChar->getActionData()) }}">{{ $firstChar->name }}</a>
                and write {{ $firstChar->gender === 'Female' ? 'her' : 'his' }} story?
            @endif
        </p>
        <p>
            Or take some time to <a href="{{ action('SearchController@getIndex') }}">search for your friends</a>
            and see what they have been up to.
        </p>
    @endif

    @if(Auth::user()->accounts->count() === 0)
        <h3>Welcome on GW2Heroes</h3>

        <p>
            We are excited to have you here!
            The first thing you should do now is to add your Guild Wars 2 Account
            so others can view all your amazing characters.
        </p>
        <p>
            <a class="input--button" href="{{ action('Settings\AccountsController@getAdd') }}">Add your Guild Wars 2 account</a>
        </p>
    @else
        <h3>Your activities</h3>
        <ul class="activity-list">
            @forelse($activities as $activity)
                <li>@include('activities.activity')</li>
            @empty
                <li>None</li>
            @endforelse
        </ul>
    @endif

@stop

@section('content.left')
    <h3>Accounts <a href="{{ action('Settings\AccountsController@getIndex') }}">Manage Accounts</a></h3>
    <ul class="home-account-list">
        @forelse($accounts as $acc)
            <li>
                <a href="{{ action('AccountController@getIndex', $acc->getActionData()) }}">
                    {{ $acc->getNameHtml() }}
                </a>
                <ul>
                    @forelse( $acc->characters as $char )
                        <li>
                            <a href="{{ $char->getUrl() }}">
                                {{ $char->name }}
                                <span class="character-info">
                                    <b>{{ $char->level }}</b> {{ $char->race }} {{ $char->profession }}
                                </span>
                            </a>
                        </li>
                    @empty
                        <li>No characters</li>
                    @endforelse
                </ul>
            </li>
        @empty
            <li>
                No accounts added yet.
                <a href="{{ action('Settings\AccountsController@getAdd') }}">Add one now</a>.
            </li>
        @endforelse
    </ul>
@endsection
