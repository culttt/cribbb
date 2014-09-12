<?php namespace Cribbb\Domain\Model;

interface Entity
{
    /**
     * Return the Entity identifer
     *
     * @return Identifier
     */
    public function id();
}
