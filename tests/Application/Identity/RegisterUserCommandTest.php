<?php namespace Cribbb\Tests\Application\Identity;

use Cribbb\Application\Identity\RegisterUserCommand;

class RegisterUserCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var RegisterUserCommand */
    private $command;

    public function setUp()
    {
        $email    = 'name@domain.com';
        $username = 'username';
        $password = 'password';
        $this->command = new RegisterUserCommand($email, $username, $password);
    }

    /** @test */
    public function should_have_gettable_properties()
    {
        $this->assertEquals('name@domain.com', $this->command->email);
        $this->assertEquals('username',        $this->command->username);
        $this->assertEquals('password',        $this->command->password);
    }
}
