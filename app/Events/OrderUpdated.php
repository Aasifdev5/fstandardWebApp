<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Order $order;

    /**
     * Create a new event instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     * We use a PrivateChannel so only the specific user receives their order update.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('orders.' . $this->order->user_id),
        ];
    }

    /**
     * The event's broadcast name.
     * This is what you listen for in Vue: .listen('.OrderUpdated', ...)
     */
    public function broadcastAs(): string
    {
        return 'OrderUpdated';
    }

    /**
     * Get the data to broadcast.
     * You can customize this if you don't want to send the entire model.
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->order->id,
            'status' => $this->order->status,
            'exit_price' => $this->order->exit_price,
            'pnl' => $this->order->pnl,
            'close_reason' => $this->order->close_reason,
            'closed_at' => $this->order->closed_at,
            // Add any other fields your frontend needs immediately
        ];
    }
}
