<?php namespace Cribbb\Domain\Model\Discussion;

use Cribbb\Domain\ValueObject;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;

class Follower implements ValueObject
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var Username
     */
    private $username;

    /**
     * Create a new Follower
     *
     * @param UserId $id
     * @param Email $email
     * @param Username $username
     * @return void
     */
    public function __construct(UserId $id, Email $email, Username $username)
    {
        $this->id       = $id;
        $this->email    = $email;
        $this->username = $username;
    }

    /**
     * Determine equality with another Value Object
     *
     * @param ValueObject $object
     * @return bool
     */
    public function equals(ValueObject $object)
    {
        return $this == $object;
    }
}
