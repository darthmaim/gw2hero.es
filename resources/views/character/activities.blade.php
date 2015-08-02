@extends('character.index')

@section('content.right')
    <h2>Activities</h2>
    <ul class="activity-list">
        @forelse($character->activities as $activity)
            <li>@include('activities.activity')</li>
        @empty
            <li>None</li>
        @endforelse
    </ul>
@stop
