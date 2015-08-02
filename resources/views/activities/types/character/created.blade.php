@if( count( $activity->user->accounts ) === 1 )
    <b>{{ Auth::id() === $activity->user->id ? 'You' : $activity->user->name }}</b>
    created a new character:
@else
    <b>{{ Auth::id() === $activity->user->id ? 'You' : $activity->user->name }}</b>
    created a new character on account {!! $activity->account->getNameHtml() !!}:
@endif
<a href="{{ $activity->character->getUrl() }}">{!! $activity->character->name !!}</a>
