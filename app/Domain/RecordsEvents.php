<?php namespace Cribbb\Domain;

trait RecordsEvents
{
    /**
     * @var array
     */
    private $events;

    /**
     * Record that an event as occurred
     *
     * @param DomainEvent $event
     * @return void
     */
    public function record(Event $event)
    {
        $this->events[] = $event;
    }

    /**
     * Release the pending events
     *
     * @return array
     */
    public function release()
    {
        $events = $this->events;

        $this->events = [];

        return $events;
    }
}
