<?php namespace Cribbb\Domain;

interface Entity
{
    /**
     * Return the Entity identifer
     *
     * @return Identifier
     */
    public function id();
}
