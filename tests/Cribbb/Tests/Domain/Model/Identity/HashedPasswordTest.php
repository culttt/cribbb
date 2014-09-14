<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Cribbb\Domain\Model\Identity\HashedPassword;

class HashedPasswordTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_password()
    {
        $this->setExpectedException('Exception');
        $password = new HashedPassword;
    }

    /** @test */
    public function should_require_valid_password()
    {
        $this->setExpectedException('Assert\AssertionFailedException');
        $password = new HashedPassword([]);
    }

    /** @test */
    public function should_accept_valid_password()
    {
        $password = new HashedPassword('ffsfewefhwuehfuiwhfiuwiufgiuwgewiugwefiuwbw');
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\HashedPassword', $password);
    }

    /** @test */
    public function should_create_from_native()
    {
        $password = HashedPassword::fromNative('qcascasercscdccastyuaacaasciop');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\HashedPassword', $password);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = new HashedPassword('qcascasercscdccastyuaacaasciop');
        $two   = new HashedPassword('qcascasercscdccastyuaacaasciop');
        $three = new HashedPassword('asddfegrthytjtyjtyjtjyjtfghjkl');

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_as_string()
    {
        $password = new HashedPassword('qcascasercscdccastyuaacaasciop');

        $this->assertEquals('qcascasercscdccastyuaacaasciop', $password->toString());
    }
}
