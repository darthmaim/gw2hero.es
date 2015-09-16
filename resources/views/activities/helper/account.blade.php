<a href="{{ action('AccountController@getIndex', $activity->account->getActionData()) }}">{{
    $activity->account->getNameHtml()
}}</a>
