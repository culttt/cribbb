<?php namespace Cribbb\Domain\Model\Identity;

use Assert\Assertion;

class HashedPassword
{
    /**
     * @var string
     */
    private $value;

    /**
     * Create a new Hashed Password
     *
     * @param string $value
     * @return void
     */
    public function __construct($value)
    {
        Assertion::string($value);

        $this->value = $value;
    }

    /**
     * Return the object as a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
