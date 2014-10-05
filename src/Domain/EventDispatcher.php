<?php namespace Cribbb\Domain;

interface EventDispatcher
{
    /**
     * Dispatch Domain Events
     *
     * @param array
     * @return void
     */
    public function dispatch(array $events);
}
