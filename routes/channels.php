<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// WEBSOCKET PRIVATE SOMEHOW ERROR ON /broadcast/auth
// {userId} is parameter, can be changed to whatever liking (affect the function parameter name as well)
Broadcast::channel("TestChannelPrivate.user.{userId}", function ($user, $userId) {
    // Usual authentication
    // $user <-- logged in user, injected from LARAVEL Middleware
    // return (int) $user->id === (int) $userId;

    // for example, only userId 1 authorized to listen the channel
    return (int) 1 == (int) $userId;
});
