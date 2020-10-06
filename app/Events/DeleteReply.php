<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteReply implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply_id;
    public $question_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($question_id,$reply_id)
    {
        $this->question_id = $question_id;
        $this->reply_id = $reply_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function broadcastOn()
    {
        return new Channel('ReplyDeleted.'.$this->question_id);
    }
}
