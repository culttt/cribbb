<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Cribbb\Domain\Model\Identity\Password;

class PasswordTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_password()
    {
        $this->setExpectedException('Exception');
        $password = new Password;
    }

    /** @test */
    public function should_require_valid_password()
    {
        $this->setExpectedException('Assert\AssertionFailedException');
        $password = new Password('abc');
    }

    /** @test */
    public function should_accept_valid_password()
    {
        $password = new Password('ffsfewefhwuehfuiwhfiuwiufgiuwgewiugwefiuwbw');
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Password', $password);
    }

    /** @test */
    public function should_create_from_native()
    {
        $password = Password::fromNative('qwertyuiop');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Password', $password);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = new Password('qwertyuiop');
        $two   = new Password('qwertyuiop');
        $three = new Password('asdfghjkl');

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_as_string()
    {
        $password = new Password('qwertyuiop');

        $this->assertEquals('qwertyuiop', $password->toString());
        $this->assertEquals('qwertyuiop', (string) $password);
    }
}
