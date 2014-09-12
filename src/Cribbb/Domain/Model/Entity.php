<?php namespace Cribbb\Domain\Model;

interface Entity
{
    /**
     * Return the Aggregate Root identifer
     *
     * @return Identifier
     */
    public function id();
}
