<?php namespace Cribbb\Stubs;

use Cribbb\Domain\Event;
use Cribbb\Domain\Listener;

class ListenerStub implements Listener
{
    /**
     * Handler a Domain Event
     *
     * @return void
     */
    public function handle(Event $event)
    {
        $counter = $event->counter;

        $counter->count++;
    }
}
