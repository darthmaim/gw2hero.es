@extends('settings.index')

@section('title', 'Settings (Notifications)')

@section('content.right')
    <h2>Emails</h2>

    {!! Form::open([/*'action' => 'Settings\SettingsController@postNotifications'*/]) !!}

    <p>
        You will get emails send to your primary email address <strong>{{ Auth::user()->email }}</strong>
        ({!! link_to_action('Settings\SettingsController@getProfile', 'edit') !!}).
    </p>

    <div class="form__field">
        {!! Form::label('email_notifications', 'Send me emails for unread notifications') !!}
        {!! Form::select('notification_emails', ['never', 'weekly', 'daily', 'every 3 hours', 'every 30 minutes'], 2) !!}
    </div>

    <div class="form__field">
        {!! Form::label('email_pm', 'Send me unread private messages') !!}
        {!! Form::select('email_pm', ['never', 'weekly', 'daily', 'every 3 hours', 'every 30 minutes', 'always'], 5) !!}
    </div>

    <div class="form__field">
        {!! Form::label('email_friendrequest', 'Send me unread friend requests') !!}
        {!! Form::select('email_friendrequest', ['never', 'weekly', 'daily', 'every 3 hours', 'every 30 minutes', 'always'], 5) !!}
    </div>


    <div class="form__field--margin-top">
        {!! Form::submit('Save email settings') !!}
    </div>

    {!! Form::close() !!}


    <h2>Notifications</h2>

    {!! Form::open([/*'action' => 'Settings\SettingsController@postNotifications'*/]) !!}

    <p>
        You will see new notifications in your <a href="/">notification center</a>.
    </p>

    <div class="form__field">
        <label>Notify me of new comments</label>
        <label class="form__checkbox">
            {!! Form::checkbox('notification_comment_mention', 1, true, ['disabled']) !!}
            Comments mentioning me ({{ '@' . auth()->user()->name }})
        </label>
        <label class="form__checkbox">
            {!! Form::checkbox('notification_comment_response', 1, true) !!}
            Comments in threads I commented on (replies)
        </label>
        <label class="form__checkbox">
            {!! Form::checkbox('notification_comment_character', 1, true) !!}
            Comments on my characters
        </label>
        <label class="form__checkbox">
            {!! Form::checkbox('notification_comment_guild', 1, false) !!}
            Comments in my guild
        </label>
    </div>

    <div class="form__field">
        <label>Notify me when one of my friends</label>
        <label class="form__checkbox">
            {!! Form::checkbox('notification_friend_new_character', 1, true) !!}
            Creates a new character
        </label>
        <label class="form__checkbox">
            {!! Form::checkbox('notification_friend_new_accoutn', 1, true) !!}
            Adds a new account
        </label>
        <label class="form__checkbox">
            {!! Form::checkbox('notification_friend_guild', 1, true) !!}
            Joins or leaves a guild
        </label>
        <label class="form__checkbox">
            {!! Form::checkbox('notification_friend_lvl80', 1, true) !!}
            Reaches level 80
        </label>
        <label class="form__checkbox">
            {!! Form::checkbox('notification_friend_add_friend', 1, false) !!}
            Adds a new friend
        </label>
    </div>

    <div class="form__field">
        <label>Guilds</label>
        <label class="form__checkbox">
            {!! Form::checkbox('notification_guild_member', 1, true) !!}
            Someone joins or leaves one of my guilds
        </label>
        <label class="form__checkbox">
            {!! Form::checkbox('notification_guild_lvl80', 1, true) !!}
            Someone in my guild reaches level 80
        </label>
    </div>


    <div class="form__field--margin-top">
        {!! Form::submit('Save notification settings') !!}
    </div>

    {!! Form::close() !!}
@endsection
