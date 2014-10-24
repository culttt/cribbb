<?php namespace Cribbb\Tests\Domain\Model\Groups;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Model\Groups\GroupId;

class GroupIdTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_instance_of_uuid()
    {
        $this->setExpectedException('Exception');

        $id = new GroupId;
    }

    /** @test */
    public function should_create_new_group_id()
    {
        $id = new GroupId(Uuid::uuid4());

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\GroupId', $id);
    }

    /** @test */
    public function should_generate_new_group_id()
    {
        $id = GroupId::generate();

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\GroupId', $id);
    }

    /** @test */
    public function should_create_group_id_from_string()
    {
        $id = GroupId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\GroupId', $id);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = GroupId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $two   = GroupId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $three = GroupId::generate();

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_group_id_as_string()
    {
        $id = GroupId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', $id->toString());
        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', (string) $id);
    }
}
