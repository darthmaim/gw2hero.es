@extends('user.index')

@section('content.right')
    <h2>Activities</h2>
    <ul class="activity-list">
        @forelse($activities as $activity)
            <li>@include('activities.activity')</li>
        @empty
            <li>None</li>
        @endforelse
    </ul>
@stop
