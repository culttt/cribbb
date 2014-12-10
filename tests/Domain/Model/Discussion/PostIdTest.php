<?php namespace Cribbb\Tests\Domain\Model\Discussion;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Model\Discussion\PostId;

class PostIdTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_instance_of_uuid()
    {
        $this->setExpectedException('Exception');

        $id = new PostId;
    }

    /** @test */
    public function should_create_new_id()
    {
        $id = new PostId(Uuid::uuid4());

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\PostId', $id);
    }

    /** @test */
    public function should_generate_new_id()
    {
        $id = PostId::generate();

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\PostId', $id);
    }

    /** @test */
    public function should_create_id_from_string()
    {
        $id = PostId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\PostId', $id);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = PostId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $two   = PostId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');
        $three = PostId::generate();

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_id_as_string()
    {
        $id = PostId::fromString('d16f9fe7-e947-460e-99f6-2d64d65f46bc');

        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', $id->toString());
        $this->assertEquals('d16f9fe7-e947-460e-99f6-2d64d65f46bc', (string) $id);
    }
}
