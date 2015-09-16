@if(Auth::id() === $activity->user->id)
    {{ isset($suffix) ? 'Your' : 'You' }}
@else
    <a href="{{ action('UserController@getIndex', $activity->user->getActionData()) }}">{{
        $activity->user->name.( isset($suffix) ? 's' : '' )
    }}</a>
@endif
