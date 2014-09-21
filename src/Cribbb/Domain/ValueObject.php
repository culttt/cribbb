<?php namespace Cribbb\Domain;

interface ValueObject
{
    /**
     * Determine equality with another Value Object
     *
     * @param ValueObject $object
     * @return bool
     */
    public function equals(ValueObject $object);
}
