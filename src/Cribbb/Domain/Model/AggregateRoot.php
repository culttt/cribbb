<?php namespace Cribbb\Domain\Model;

interface AggregateRoot
{
    /**
     * Add an event to the pending events
     *
     * @param $event
     * @return void
     */
    public function record($event);

    /**
     * Release the events
     *
     * @return array
     */
    public function release();
}
