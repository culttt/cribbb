<?php namespace Cribbb\Domain\Model\Identity;

use Assert\Assertion;
use Cribbb\Domain\ValueObject;

class Username implements ValueObject
{
    /**
     * @var string
     */
    private $value;

    /**
     * Create a new Username
     *
     * @param string $username
     * @return void
     */
    public function __construct($value)
    {
        Assertion::regex($value, '/^[\pL\pM\pN_-]+$/u');

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

    /**
     * Create a new instance from a native form
     *
     * @param mixed $native
     * @return ValueObject
     */
    public static function fromNative($native)
    {
        return new Username($native);
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

    /**
     * Return the object as a string
     *
     * @return string
     */
    public function toString()
    {
        return $this->value;
    }
}
