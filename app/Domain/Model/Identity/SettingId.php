<?php namespace Cribbb\Domain\Model\Identity;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Identifier;
use Cribbb\Domain\UuidIdentifier;

class SettingId extends UuidIdentifier implements Identifier
{
    /**
     * @var Uuid
     */
    protected $value;

    /**
     * Create a new SettingId
     *
     * @return void
     */
    public function __construct(Uuid $value)
    {
        $this->value = $value;
    }
}
