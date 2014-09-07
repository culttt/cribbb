<?php namespace Cribbb\Domain\Model\Cribbbs;

use Rhumsaa\Uuid\Uuid;

class CribbbIdTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_instance_of_uuid()
    {
        $this->setExpectedException('Exception');

        $id = new CribbbId;
    }

    /** @test */
    public function should_create_new_cribbb_id()
    {
        $id = new CribbbId(Uuid::uuid4());

        $this->assertInstanceOf('Cribbb\Domain\Model\Cribbbs\CribbbId', $id);
    }

    /** @test */
    public function should_create_cribbb_id_from_string()
    {
        $id = CribbbId::fromString('fa5852c9-013c-44b4-b08f-ca465aae5275');

        $this->assertInstanceOf('Cribbb\Domain\Model\Cribbbs\CribbbId', $id);
    }
}
