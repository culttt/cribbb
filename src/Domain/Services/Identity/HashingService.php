<?php namespace Cribbb\Domain\Services\Identity;

use Cribbb\Domain\Model\Identity\Password;

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
