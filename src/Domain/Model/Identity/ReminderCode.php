<?php namespace Cribbb\Domain\Model\Identity;

use RuntimeException;
use Cribbb\Domain\ValueObject;

class ReminderCode implements ValueObject
{
    /**
     * @var string
     */
    private $value;

    /**
     * Create a new ReminderCode
     *
     * @param string $value
     * @return void
     */
    private function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Generate a new ReminderCode
     *
     * @return ReminderCode
     */
    public static function generate($length = 40)
    {
        $bytes = openssl_random_pseudo_bytes($length * 2);

        if (! $bytes)
        {
            throw new RuntimeException('Failed to generate token');
        }

        return new static(substr(str_replace(['+', '=', '/'], '', base64_encode($bytes)), 0, $length));
    }

    /**
     * Create a new instance from a native form
     *
     * @param mixed $native
     * @return ValueObject
     */
    public static function fromNative($native)
    {
        return new ReminderCode($native);
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
