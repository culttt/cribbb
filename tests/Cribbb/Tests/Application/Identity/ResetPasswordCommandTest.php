<?php namespace Cribbb\Application\Identity;

use Cribbb\Application\Identity\ResetPasswordCommand;

class ResetPasswordCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_create_reset_password_command()
    {
        $command = new ResetPasswordCommand('name@domain.com', 'password', 'abc123');

        $this->assertEquals('name@domain.com', $command->email);
        $this->assertEquals('password',        $command->password);
        $this->assertEquals('abc123',          $command->code);
    }
}
