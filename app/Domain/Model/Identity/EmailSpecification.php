<?php namespace Cribbb\Domain\Model\Identity;

interface EmailSpecification
{
    /**
     * Check to see if the specification is satisfied
     *
     * @param Email $email
     * @return bool
     */
    public function isSatisfiedBy(Email $email);
}
