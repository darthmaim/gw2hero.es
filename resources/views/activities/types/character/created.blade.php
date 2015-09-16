@if( count( $activity->user->accounts ) === 1 )
    @include('activities.helper.user') created a new character:
    @include('activities.helper.character').
@else
    @include('activities.helper.user') created a new character on account @include('activities.helper.account'):
    @include('activities.helper.character').
@endif
