<?php

namespace App\Events;

use App\Models\Tickets;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Ticket
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $ticket;
    public function __construct(Tickets $tickets)
    {
        $this->ticket = $tickets;
    }
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
