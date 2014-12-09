<?php namespace Cribbb\Tests\Domain\Model\Discussion;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Model\Discussion\ThreadId;

class ThreadIdTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_instance_of_uuid()
    {
        $this->setExpectedException('Exception');

        $id = new ThreadId;
    }

    /** @test */
    public function should_create_new_thread_id()
    {
        $id = new ThreadId(Uuid::uuid4());

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\ThreadId', $id);
    }

    /** @test */
    public function should_generate_new_thread_id()
    {
        $id = ThreadId::generate();

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\ThreadId', $id);
    }

    /** @test */
    public function should_create_thread_id_from_string()
    {
        $id = ThreadId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\ThreadId', $id);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = ThreadId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $two   = ThreadId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $three = ThreadId::generate();

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_thread_id_as_string()
    {
        $id = ThreadId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', $id->toString());
        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', (string) $id);
    }
}
