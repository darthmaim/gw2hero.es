@extends('admin.index')

@section('content.right')
    <h2>Users</h2>

    @include('layout.form-errors')

    <div class="table-wrapper">
        <table class="table table--sortable">
            <thead>
            <tr>
                <th data-sort-method="number">ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="c">{{ $user->id }}</td>
                    <td><a href="{{ action('UserController@getIndex', $user->getActionData()) }}">
                            {{ $user->name }}
                            @if($user->is_admin)
                                <span class="user-badge--admin">A</span>
                            @endif
                    </a></td>
                    <td><a href="mailto:{{ $user->email }}">
                        {{ $user->email }}
                    </a></td>
                    <td data-sort="{{ $user->created_at->timestamp }}" class="c">
                        {{ $user->created_at->diffForHumans(null, false) }} <wbr>({{ $user->created_at->format('d.m.Y') }})
                    </td>
                    <td>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
