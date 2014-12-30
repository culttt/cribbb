<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Model\Identity\NotificationId;

class NotificationIdTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_instance_of_uuid()
    {
        $this->setExpectedException('Exception');

        $id = new NotificationId;
    }

    /** @test */
    public function should_create_new_id()
    {
        $id = new NotificationId(Uuid::uuid4());

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\NotificationId', $id);
    }

    /** @test */
    public function should_generate_new_id()
    {
        $id = NotificationId::generate();

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\NotificationId', $id);
    }

    /** @test */
    public function should_create_id_from_string()
    {
        $id = NotificationId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\NotificationId', $id);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = NotificationId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $two   = NotificationId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $three = NotificationId::generate();

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_id_as_string()
    {
        $id = NotificationId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', $id->toString());
        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', (string) $id);
    }
}
