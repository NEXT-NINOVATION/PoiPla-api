<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ThrowEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $count, $dust_box;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($dust_box, $count)
    {
        //
        $this->dust_box = $dust_box;
        return $this->count = $count;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return ['dust-box-' . $dustBoxId];
    }

    public function broadcastAs()
    {
        return 'dust-box-' . $this->dust_box->id;
    }
}
