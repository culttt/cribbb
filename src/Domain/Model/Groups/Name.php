<?php namespace Cribbb\Domain\Model\Groups;

use Assert\Assertion;
use Illuminate\Support\Str;
use Cribbb\Domain\ValueObject;

class Name implements ValueObject
{
    /**
     * @var string
     */
    private $value;

    /**
     * Create a new Name
     *
     * @param string $value
     * @return void
     */
    public function __construct($value)
    {
        Assertion::regex($value, '/^[\pL\pM\pN_-]+$/u');

        $this->value = $value;
    }

    /**
     * Create a Slug from the Name
     *
     * @return Slug
     */
    public function toSlug()
    {
        return new Slug(Str::slug(strtolower($this->value)));
    }

    /**
     * Create a new instance from a native form
     *
     * @param mixed $native
     * @return ValueObject
     */
    public static function fromNative($native)
    {
        return new Name($native);
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
