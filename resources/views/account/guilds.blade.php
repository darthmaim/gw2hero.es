@extends('account.index')

@section('title', e($account->name).' (Guilds)')

@section('content.right')
    <h2>Guilds</h2>

    <div class="table-wrapper">
        <table class="table table--sortable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th data-sort-method="number">Members</th>
                </tr>
            </thead>
            <tbody>
            @foreach($account->memberOf as $guild)
                <tr>
                    <td><a href="{{ action('GuildController@getIndex', $guild->getActionData()) }}">
                        {{ $guild->getNameHtml() }}
                    </a></td>
                    <td data-sort="{{ $guild->member_count }}">{{ $guild->member_count }}/{{ $guild->member_capacity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
