<?php namespace Cribbb\Domain;

interface DomainEvent
{
    /**
     * Return the name of the DomainEvent
     *
     * @return string
     */
    public function name();
}
