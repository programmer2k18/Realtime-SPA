<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{questionID}', function ($user, $id) {
    return true;
});

Broadcast::channel('LikeReply', function () {
    return true;
});

Broadcast::channel('ReplyDeleted.{questionID}', function () {
    return true;
});