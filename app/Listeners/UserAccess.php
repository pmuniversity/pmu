<?php

namespace PMU\Listeners;

use PMU\Events\UserAccess as UserAccessEvent;
use PMU\Services\Locale;
use PMU\Services\Status;

class UserAccess
{
    /**
     * Handle the event.
     *
     * @param UserAccess $event
     *
     * @return void
     */
    public function handle(UserAccessEvent $event)
    {
        Status::setStatus();

        Locale::setLocale();
    }
}
