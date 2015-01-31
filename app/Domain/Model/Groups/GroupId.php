<?php namespace Cribbb\Domain\Model\Groups;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Identifier;
use Cribbb\Domain\UuidIdentifier;

class GroupId extends UuidIdentifier implements Identifier
{
    /**
     * @var Uuid
     */
    protected $value;

    /**
     * Create a new GroupId
     *
     * @return void
     */
    public function __construct(Uuid $value)
    {
        $this->value = $value;
    }
}
