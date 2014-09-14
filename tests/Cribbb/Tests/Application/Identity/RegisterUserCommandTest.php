<?php namespace Cribbb\Application\Identity;

use Cribbb\Application\Identity\RegisterUserCommand;

class RegisterUserCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_create_register_user_command()
    {
        $command = new RegisterUserCommand('name@domain.com', 'username', 'password');

        $this->assertEquals('name@domain.com', $command->email);
        $this->assertEquals('username',        $command->username);
        $this->assertEquals('password',        $command->password);
    }
}
