<?php namespace Cribbb\Domain\Model\Identity;

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
}
