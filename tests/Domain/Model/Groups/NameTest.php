<?php namespace Cribbb\Tests\Domain\Model\Groups;

use Cribbb\Domain\Model\Groups\Name;

class NameTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_name()
    {
        $this->setExpectedException('Exception');
        $name = new Name;
    }

    /** @test */
    public function should_require_valid_name()
    {
        $this->setExpectedException('Assert\AssertionFailedException');
        $name = new Name('???');
    }

    /** @test */
    public function should_accept_valid_name()
    {
        $name = new Name('Cribbb');
        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Name', $name);
    }

    /** @test */
    public function should_create_from_native()
    {
        $name = Name::fromNative('Cribbb');

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Name', $name);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = new Name('Cribbb');
        $two   = new Name('Cribbb');
        $three = new Name('Twitter');

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_as_string()
    {
        $name = new Name('Cribbb');

        $this->assertEquals('Cribbb', $name->toString());
        $this->assertEquals('Cribbb', (string) $name);
    }
}
