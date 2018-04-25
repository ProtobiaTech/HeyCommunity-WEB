<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Auth;

class UserLoggedByWechatTransferBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    protected $token;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
        $this->user = array_only(Auth::user()->toArray(), ['id', 'nickname']);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('logged-by-wechat-transfer-t-' . $this->token);
    }

    public function broadcastAs()
    {
        return 'transfer';
    }
}
