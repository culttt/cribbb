<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Model\Identity\SettingId;

class SettingIdTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_instance_of_uuid()
    {
        $this->setExpectedException('Exception');

        $id = new SettingId;
    }

    /** @test */
    public function should_create_new_id()
    {
        $id = new SettingId(Uuid::uuid4());

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\SettingId', $id);
    }

    /** @test */
    public function should_generate_new_id()
    {
        $id = SettingId::generate();

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\SettingId', $id);
    }

    /** @test */
    public function should_create_id_from_string()
    {
        $id = SettingId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\SettingId', $id);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = SettingId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $two   = SettingId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $three = SettingId::generate();

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_id_as_string()
    {
        $id = SettingId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', $id->toString());
        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', (string) $id);
    }
}
