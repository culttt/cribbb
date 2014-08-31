<?php namespace Cribbb\Domain\Model\Identity\Events;

use BigName\EventDispatcher\Event;

class UserHasRegistered implements Event
{
    /**
     * Return the name of the event
     *
     * @return string
     */
    public function getName()
    {
        return 'UserHasRegistered';
    }
}
