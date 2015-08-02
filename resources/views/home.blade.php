@extends('layout.wrapper')

@section('title', 'home')

@section('content.right')
	<h2>lang.home-header</h2>

	<div>
		You are logged in! <a href="{{ action('Auth\AuthController@getLogout') }}">Logout</a>
	</div>

    <h3>Your activities</h3>
    <ul class="activity-list">
        @forelse($activities as $activity)
            <li>@include('activities.activity')</li>
        @empty
            <li>None</li>
        @endforelse
    </ul>
@stop

@section('content.left')
    <h3>Accounts <a href="{{ action('Settings\AccountsController@getIndex') }}">Manage Accounts</a></h3>
    <ul class="home-account-list">
        @forelse($accounts as $acc)
            <li>
                @include('helper.accountName', [ 'account' => $acc ])
                <ul>
                    @forelse( $acc->characters as $char )
                        <li>
                            <a href="{{ $char->getUrl() }}">
                                {{ $char->name }}
                                <span class="character-info">Level {{ $char->level }} {{ $char->race }} {{ $char->profession }}</span>
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
