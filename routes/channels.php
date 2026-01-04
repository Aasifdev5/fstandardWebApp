<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
*/

// 🔹 Private chat (keep this)
Broadcast::channel('chat.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

// 🔹 PUBLIC market channels (VERY IMPORTANT)
Broadcast::channel('market.underlying.{symbol}', function () {
    return true;
});

Broadcast::channel('market.futures.{symbol}', function () {
    return true;
});

Broadcast::channel('market.options.{symbol}', function () {
    return true;
});
Broadcast::channel('orders.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
