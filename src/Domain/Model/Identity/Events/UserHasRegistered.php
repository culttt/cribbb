<?php namespace Cribbb\Domain\Model\Identity\Events;

use Cribbb\Domain\DomainEvent;

class UserHasRegistered implements DomainEvent
{
    /**
     * Return the name of the DomainEvent
     *
     * @return string
     */
    public function name()
    {
        return 'UserHasRegistered';
    }
}
