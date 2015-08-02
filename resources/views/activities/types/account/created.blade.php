<b>{{ Auth::id() === $activity->user->id ? 'You' : $activity->user->name }}</b>
added a new account: <b>{{ $activity->account->getNameHtml() }}</b>
