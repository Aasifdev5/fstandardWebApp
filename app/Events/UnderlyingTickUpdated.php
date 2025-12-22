<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class UnderlyingTickUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $symbol;
    public float $price;
    public string $timestamp;

    public function __construct(string $symbol, float $price, Carbon $timestamp)
    {
        $this->symbol = $symbol;
        $this->price = $price;
        // Format to ISO string for Javascript compatibility
        $this->timestamp = $timestamp->toIso8601String();
    }

    public function broadcastOn(): Channel
    {
        return new Channel('market.underlying.' . $this->symbol);
    }

    public function broadcastAs(): string
    {
        // This is what the frontend .listen('.TickUpdated') looks for
        return 'TickUpdated';
    }
}
