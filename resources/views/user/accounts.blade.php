@extends('user.index')

@section('content.right')
    <h2>Accounts</h2>

    <ul>
        @foreach($user->accounts as $account)
        <li><a href="{{ action('AccountController@getIndex', $account->getActionData()) }}">
            {{ $account->getNameHtml() }}
        </a></li>
        @endforeach
    </ul>
@endsection
