@include('activities.helper.account') joined
<?php $guild = \GW2Heroes\Models\Guild::find($activity->data->guild) ?>
<a href="{{ action('GuildController@getIndex', $guild->getActionData()) }}">{{ $guild->getNameHtml() }}</a>.
