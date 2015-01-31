<?php namespace Cribbb\Domain;

interface Event
{
    /**
     * Return the name of the Domain Event
     *
     * @return string
     */
    public function name();
}
