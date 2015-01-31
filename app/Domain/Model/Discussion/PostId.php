<?php namespace Cribbb\Domain\Model\Discussion;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Identifier;
use Cribbb\Domain\UuidIdentifier;

class PostId extends UuidIdentifier implements Identifier
{
    /**
     * @var Uuid
     */
    protected $value;

    /**
     * Create a new Identifier
     *
     * @return void
     */
    public function __construct(Uuid $value)
    {
        $this->value = $value;
    }
}
