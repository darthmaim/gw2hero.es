@extends('character.index')

@section('content.right')
    <h2>Summary</h2>
    <h3>Statistics</h3>
    <dl class="statistics-list">
        <dt>Age</dt><dd>{{ $character->created->diffForHumans(null, true) }} ({{ $character->created->format('d.m.Y') }})</dd>
        <dt>Played</dt><dd>{{ ($age = $character->age / 60 / 60) < 1 ? '<1' : round($age) }} hours</dd>
        <dt>Deaths</dt><dd>{{ $character->deaths }}</dd>
        <dt>Gender</dt><dd>{{ $character->gender }}</dd>
    </dl>
@stop
