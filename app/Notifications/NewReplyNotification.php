<?php

namespace App\Notifications;

use App\Http\Resources\Reply\ReplyResource;
use App\Models\Reply;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReplyNotification extends Notification
{
    use Queueable;

    protected $reply;
    protected $type;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply, $type)
    {
        $this->reply = $reply;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'replyBy'=>$this->reply->user->name,
            'title'=>$this->reply->question->title,
            'reply_body'=>$this->reply->body,
            'path'=>$this->reply->question->path(),
            'reply'=>new ReplyResource($this->reply),

        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */

    public function broadcastOn()
    {
        if ($this->type == 'notifyOthers')
            return new Channel('App.User.'.$this->reply->question->id);
        return new Channel('App.User.'.$this->reply->question->user_id);
    }
}
