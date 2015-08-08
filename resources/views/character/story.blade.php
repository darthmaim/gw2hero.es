@extends('character.index')

@section('content.right')
    <h2>Story</h2>
    <p style="font-style: italic">
        {{ $character->account->user->name }} hasn't written the story of {{ $character->name }} yet.
    </p>
@stop
