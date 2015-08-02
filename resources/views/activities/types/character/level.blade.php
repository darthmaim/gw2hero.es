<b>{{ Auth::id() === $activity->user->id ? 'Your' : $activity->user->name . 's' }}</b> character
<a href="{{ $activity->character->getUrl() }}">{{ $activity->character->name }}</a>
reached level {{ $activity->data }}
