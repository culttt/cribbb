<?php namespace Cribbb\Domain\Model;

use BigName\EventDispatcher\Event;

interface AggregateRoot
{
    /**
     * Return the Aggregate Root identifer
     *
     * @return Identifier
     */
    public function id();

    /**
     * Add an event to the pending events
     *
     * @param Event $event
     * @return void
     */
    public function record(Event $event);

    /**
     * Release the events
     *
     * @return array
     */
    public function release();
}
