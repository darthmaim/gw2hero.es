@if( count( $activity->user->accounts ) === 1 )
    <b>{{ $activity->user->name }}</b> created a new character:
@else
    <b>{{ $activity->user->name }}</b> created a new character
    on account {!! $activity->account->getNameHtml() !!}:
@endif
<a href="{{ $activity->character->getUrl() }}">{!! $activity->character->name !!}</a>
