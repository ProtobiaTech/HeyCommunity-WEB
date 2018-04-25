<?php

namespace App\Listeners;

use App\Events\TopicNotice;
use App\Notice;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TopicNoticeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TopicNotice  $event
     * @return void
     */
    public function handle(TopicNotice $event)
    {
        if ($event->userId != $event->senderId) {
            $notice = Notice::create([
                'user_id'       =>  $event->userId,
                'sender_id'     =>  $event->senderId,
                'entity_name'   =>  $event->entityName,
                'entity_class'  =>  get_class($event->entity),
                'entity_id'     =>  $event->entity->id,
            ]);
        }
    }
}
