@include('activities.helper.account') left
<?php $guild = \GW2Heroes\Models\Guild::find($activity->data->guild) ?>
<a href="{{ action('GuildController@getIndex', $guild->getActionData()) }}">{{ $guild->getNameHtml() }}</a>.
