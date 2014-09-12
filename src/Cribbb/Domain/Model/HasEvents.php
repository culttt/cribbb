<?php namespace Cribbb;

trait HasEvents
{
    /**
     * @var array
     */
    private $events;

    /**
     * Record that an event as occurred
     *
     * @param $event
     * @return void
     */
    public function record($event)
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
