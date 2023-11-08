<?php

namespace App\Events;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $to;

    /**
     * Create a new event instance.
     */
    public function __construct($to , $data)
    {
        $this->to = $to;

        $message = Message::create($data);

        $message->user =  \Http::get('http://crm.orzugrand.uz/api/user/'.$message->author)->json()['data']??'';

        $data1 =   new MessageResource($message);

        $this->data = $data1;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('message'.$this->to),
        ];
    }
    public function broadcastAs()
    {
        return 'message';
    }

    public function broadcastWith()
    {
        return [
            $this->data
        ];
    }
}
