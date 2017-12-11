<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class TopicNotice
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $type;

    public $entity;

    public $userId;

    public $senderId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($type, $entity, $user = null, $sender = null)
    {
        $this->type = $type;
        $this->entity = $entity;

        $this->userId = is_int($user) ? $user : $user->id;
        $this->senderId = is_int($sender) ? $sender : $sender->id;
    }
}
