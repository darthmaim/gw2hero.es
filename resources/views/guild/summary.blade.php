@extends('guild.index')

@section('content.right')
    <h2>Summary</h2>

    <h3>Members</h3>

    <div class="table-wrapper">
        <table class="table table--sortable">
            <thead>
            <tr>
                <th>Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach($guild->members as $account)
                <tr>
                    <td><a href="{{ action('AccountController@getIndex', $account->getActionData()) }}">
                        {{ $account->getNameHtml() }}
                    </a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
