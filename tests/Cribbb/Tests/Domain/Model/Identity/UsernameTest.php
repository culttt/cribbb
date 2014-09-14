<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Cribbb\Domain\Model\Identity\Username;

class UsernameTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_username()
    {
        $this->setExpectedException('Exception');
        $username = new Username;
    }

    /** @test */
    public function should_require_valid_username()
    {
        $this->setExpectedException('Assert\AssertionFailedException');
        $username = new Username('@@@');
    }

    /** @test */
    public function should_accept_valid_username()
    {
        $username = new Username('philipbrown');
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Username', $username);
    }

    /** @test */
    public function should_create_from_native()
    {
        $username = Username::fromNative('philipbrown');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Username', $username);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = new Username('philipbrown');
        $two   = new Username('philipbrown');
        $three = new Username('john');

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_as_string()
    {
        $username = new Username('philipbrown');

        $this->assertEquals('philipbrown', $username->toString());
    }
}
