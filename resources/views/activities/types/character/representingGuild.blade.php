@include('activities.helper.user', ['suffix' => true]) character
@include('activities.helper.character') is now representing
<?php $guild = \GW2Heroes\Models\Guild::find($activity->data->guild) ?>
<a href="{{ action('GuildController@getIndex', $guild->getActionData()) }}">{{ $guild->getNameHtml() }}</a>.
