<?php namespace Cribbb\Domain\Model\Identity;

interface HashingService
{
    /**
     * Create a new hashed password
     *
     * @param Password $password
     * @return HashedPassword
     */
    public function hash(Password $password);
}
