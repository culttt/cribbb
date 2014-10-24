<?php namespace Cribbb\Domain\Model\Groups;

interface NameSpecification
{
    /**
     * Check to see if the specification is satisfied
     *
     * @param Name $name
     * @return bool
     */
    public function isSatisfiedBy(Name $name);
}
