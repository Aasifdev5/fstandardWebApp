<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Carbon\Carbon;

class FuturesTickUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $symbol, $price, $timestamp;

    public function __construct(string $symbol, float $price, Carbon $timestamp)
    {
        $this->symbol = $symbol;
        $price = $price;
        $timestamp = $timestamp;
    }

    public function broadcastOn()
    {
        return new Channel('market.futures.' . $this->symbol);
    }
}
