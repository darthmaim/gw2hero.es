@if( count( $activity->user->accounts ) === 1 )
    @include('activities.helper.user') deleted a character:
    @include('activities.helper.character').
@else
    @include('activities.helper.user') deleted a character on account @include('activities.helper.account'):
    @include('activities.helper.character').
@endif
