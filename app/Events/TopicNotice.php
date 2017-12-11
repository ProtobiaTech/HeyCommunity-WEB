<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class TopicNotice
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $entityName;

    public $entity;

    public $userId;

    public $senderId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($entityName, $entity, $user = null, $sender = null)
    {
        $this->entityName = $entityName;
        $this->entity = $entity;

        $this->userId = is_int($user) ? $user : $user->id;
        $this->senderId = is_int($sender) ? $sender : $sender->id;
    }
}
