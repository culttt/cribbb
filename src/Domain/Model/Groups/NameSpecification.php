<?php namespace Cribbb\Domain\Model\Groups;

interface NameSpecification
{
    /**
     * Check to see if the specification is satisfied
     *
     * @param string $name
     * @return bool
     */
    public function isSatisfiedBy($name);
}
