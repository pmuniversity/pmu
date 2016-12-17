<?php

namespace PMU\Events;

use Illuminate\Queue\SerializesModels;

class UserAccess extends Event
{
    use SerializesModels;

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
