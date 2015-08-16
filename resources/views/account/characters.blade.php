@extends('account.index')

@section('content.right')
    <h2>Characters</h2>

    <div class="table-wrapper">
        <table class="table table--sortable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th data-sort-method="number">Level</th>
                    <th>Profession</th>
                    <th>Race</th>
                    <th data-sort-method="number" class="sort-default">Age</th>
                    <th data-sort-method="number">Played</th>
                </tr>
            </thead>
            <tbody>
            @foreach($account->characters as $character)
                <tr>
                    <td><a href="{{ action('CharacterController@getIndex', $character->getActionData()) }}">
                        {{ $character->name }}
                    </a></td>
                    <td class="c">{{ $character->level }}</td>
                    <td>{{ $character->profession }}</td>
                    <td>{{ $character->race }}</td>
                    <td data-sort="{{ $character->created->timestamp }}" class="c">
                        {{ $character->created->diffForHumans(null, true) }} <wbr>({{ $character->created->format('d.m.Y') }})
                    </td>
                    <td data-sort="{{ $character->age }}" class="r">
                        {{ ($age = $character->age / 60 / 60) < 1 ? '<1' : round($age) }} hours
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
