<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UnderlyingTickUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $symbol, $lastPrice, $timestamp;

    public function __construct($symbol, $lastPrice, $timestamp)
    {
        $this->symbol = $symbol;
        $this->lastPrice = $lastPrice;
        $this->timestamp = $timestamp;
    }

    public function broadcastOn()
    {
        return new Channel('market.underlying.' . $this->symbol);
    }
}
