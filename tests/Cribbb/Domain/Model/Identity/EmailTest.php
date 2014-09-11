<?php namespace Cribbb\Domain\Model\Identity;

class EmailTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_email()
    {
        $this->setExpectedException('Exception');
        $email = new Email;
    }

    /** @test */
    public function should_require_valid_email()
    {
        $this->setExpectedException('Assert\AssertionFailedException');
        $email = new Email('this_is_not_a_valid_email');
    }

    /** @test */
    public function should_accept_valid_email()
    {
        $email = new Email('name@domain.com');
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Email', $email);
    }

    /** @test */
    public function should_create_from_native()
    {
        $email = Email::fromNative('name@domain.com');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Email', $email);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = new Email('name@domain.com');
        $two   = new Email('name@domain.com');
        $three = new Email('name@domain.net');

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_as_string()
    {
        $email = new Email('name@domain.com');

        $this->assertEquals('name@domain.com', $email->toString());
    }
}
