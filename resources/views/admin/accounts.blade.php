@extends('admin.index')

@section('content.right')
    <h2>Accounts</h2>

    @include('layout.form-errors')

    <div class="table-wrapper">
        <table class="table table--sortable">
            <thead>
            <tr>
                <th data-sort-method="number">ID</th>
                <th>Name</th>
                <th>User</th>
                <th>API-Key</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($accounts as $account)
                <tr>
                    <td class="c">{{ $account->id }}</td>
                    <td><a href="{{ action('AccountController@getIndex', $account->getActionData()) }}">
                            {{ $account->getNameHtml() }}
                    </a></td>
                    <td><a href="{{ action('UserController@getIndex', $account->user->getActionData()) }}">
                            {{ $account->user->name }} [{{ $account->user->id }}]
                        </a></td>
                    <td>
                        {{ $account->api_key_valid ? '🙂' : '❌' }}
                        <a href="javascript:alert('{{ $account->api_key }}')">View</a>
                    </td>
                    <td>
                        {!! Form::open() !!}
                        {!! Form::hidden('account', $account->id) !!}
                        @if(!$account->api_key_valid)
                            <button type="submit" class="small" formaction="{{ action('AdminController@postValidateApiKey') }}">
                                Mark API Key as valid
                            </button>
                        @endif
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
