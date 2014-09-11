<?php namespace Cribbb\Domain\Model;

use Rhumsaa\Uuid\Uuid;

abstract class UuidIdentifier implements Identifier
{
    /**
     * Generate a new Identifier
     *
     * @return Identifier
     */
    public static function generate()
    {
        return new static(Uuid::uuid4());
    }

    /**
     * Creates an identifier object from a string
     *
     * @param $string
     * @return Identifier
     */
    public static function fromString($string)
    {
        return new static(Uuid::fromString($string));
    }

    /**
     * Determine equality with another Value Object
     *
     * @param Identifier $other
     * @return bool
     */
    public function equals(Identifier $other)
    {
        return $this == $other;
    }

    /**
     * Return the identifier as a string
     *
     * @return string
     */
    public function toString()
    {
        return $this->value->toString();
    }

    /**
     * Return the identifier as a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value->toString();
    }
}
