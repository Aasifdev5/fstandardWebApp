<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PsychometricUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $state;
    public $explanation;

    public function __construct($userId, $state, $explanation)
    {
        $this->userId = $userId;
        $this->state = $state; // The current_state object
        $this->explanation = $explanation;
    }

    public function broadcastOn()
    {
        // Matches the listener in your Vue component: user.psychometrics.{id}
        return new PrivateChannel('user.psychometrics.' . $this->userId);
    }

    public function broadcastAs()
    {
        return 'PsychometricUpdated';
    }
}
