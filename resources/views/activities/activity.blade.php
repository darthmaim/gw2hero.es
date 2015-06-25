@if(View::exists('activities.types.' . $activity->type))
    @include('activities.types.' . $activity->type)
@else
    Unknown Activity [{{ $activity->type }}]
@endif
