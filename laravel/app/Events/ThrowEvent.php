<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use App\Models\ClatterResult;

class ThrowEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $count, $dust_box;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($dust_box, $session)
    {
        //
        $user_id = Auth::user()->id;
        if($session->user_id == $user_id){
            $this->dust_box = $dust_box;
            $this->count = ClatterResult::where("session_id", $session->id)->get()->count();
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
        return ["dust-box-" . $this->dust_box->id];
    }

    public function broadcastAs()
    {
        return "dust-box-" . $this->dust_box->id;
    }
}
