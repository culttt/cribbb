<?php namespace Cribbb\Domain\Model\Cribbbs;

use Rhumsaa\Uuid\Uuid;

class CribbbId
{
    /**
     * @var Uuid
     */
    private $value;

    /**
     * Create a new Uuid instance
     *
     * @return void
     */
    public function __construct(Uuid $value)
    {
        $this->value = $value;
    }

    /**
     * Create a CribbbId from a string
     *
     * @param string $cribbbId
     * @return CribbbId
     */
    public static function fromString($cribbbId)
    {
        return new CribbbId(Uuid::fromString($cribbbId));
    }

    /**
     * Return the object as a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value->toString();
    }
}
