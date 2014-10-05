<?php namespace Cribbb\Domain;

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
     * @param DomainEvent $event
     * @return void
     */
    public function record(DomainEvent $event);

    /**
     * Release the events
     *
     * @return array
     */
    public function release();
}
