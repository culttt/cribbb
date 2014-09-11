<?php namespace Cribbb\Domain\Model\Identity;

use Rhumsaa\Uuid\Uuid;

class UserIdTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_instance_of_uuid()
    {
        $this->setExpectedException('Exception');

        $id = new UserId;
    }

    /** @test */
    public function should_create_new_user_id()
    {
        $id = new UserId(Uuid::uuid4());

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\UserId', $id);
    }

    /** @test */
    public function should_generate_new_user_id()
    {
        $id = UserId::generate();

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\UserId', $id);
    }

    /** @test */
    public function should_create_user_id_from_string()
    {
        $id = UserId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\UserId', $id);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = UserId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $two   = UserId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $three = UserId::generate();

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_user_id_as_string()
    {
        $id = UserId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', $id->toString());
    }
}
