<?php namespace Cribbb\Domain\Model\Identity;

interface UsernameSpecification
{
    /**
     * Check to see if the specification is satisfied
     *
     * @param Username $username
     * @return bool
     */
    public function isSatisfiedBy(Username $username);
}
