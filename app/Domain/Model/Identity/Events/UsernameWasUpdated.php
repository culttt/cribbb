<?php namespace Cribbb\Domain\Model\Identity\Events;

use Cribbb\Domain\Event;

class UsernameWasUpdated implements Event
{
    /**
     * Return the name of the Domain Event
     *
     * @return string
     */
    public function name()
    {
        return 'UsernameWasUpdated';
    }
}
