<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Carbon\Carbon;

class OptionsTickUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $symbol;
    public float $price;
    public Carbon $timestamp;

    public function __construct(string $symbol, float $price, ?Carbon $timestamp = null)
    {
        $this->symbol = $symbol;
        $this->price = $price;
        $this->timestamp = $timestamp ?? Carbon::now();
    }

    public function broadcastOn()
    {
        return new Channel('market.options.' . $this->symbol);
    }

    // ADD THIS METHOD
    public function broadcastAs()
    {
        return 'TickUpdated';
    }
}
