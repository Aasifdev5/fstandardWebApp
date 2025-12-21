<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Carbon\Carbon;

class UnderlyingTickUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $symbol;
    public float $price;
    public Carbon $timestamp;

    public function __construct(string $symbol, float $price, Carbon $timestamp)
    {
        $this->symbol = $symbol;
        $this->price = $price;
        $this->timestamp = $timestamp;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('market.underlying.' . $this->symbol);
    }
}
