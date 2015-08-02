<div class="activity">
    @if(View::exists('activities.types.' . $activity->type))
        @include('activities.types.' . $activity->type)
    @else
        Unknown Activity [{{ $activity->type }}]
    @endif

    <time datetime="{{ $activity->created_at }}">{{ $activity->created_at->diffForHumans() }}</time>
</div>

