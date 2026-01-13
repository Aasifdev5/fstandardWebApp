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

// 🔹 User Chat (Private)
Broadcast::channel('chat.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

// 🔹 User Orders (Private) - 🔥 FIXES YOUR 403 ERROR
Broadcast::channel('orders.{userId}', function ($user, $userId) {
    // Only allow the user to listen to their own orders
    return (int) $user->id === (int) $userId;
});

// 🔹 Market Data
// Note: If frontend uses .channel() (Public), these are ignored.
// If frontend uses .private() (Authenticated), these allow any logged-in user.
Broadcast::channel('market.underlying.{symbol}', function ($user) {
    return true; // Any logged-in user can listen
});

Broadcast::channel('market.futures.{symbol}', function ($user) {
    return true;
});

Broadcast::channel('market.options.{symbol}', function ($user) {
    return true;
});
