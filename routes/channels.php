<?php

use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('message', function ($user) {
    return true; // Misol uchun har qanday foydalanuvchi uchun ruxsat beramiz
});
Broadcast::channel('clik', function ($user) {
    return true; // Misol uchun har qanday foydalanuvchi uchun ruxsat beramiz
});
