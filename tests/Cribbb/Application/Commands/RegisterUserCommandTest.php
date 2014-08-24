<?php namespace Cribbb\Application\Commands;

class RegisterUserCommandTest extends \PHPUnit_Framework_TestCase {

  /** @test */
  public function should_require_email()
  {
    $this->setExpectedException('Assert\AssertionFailedException');

    $command = new RegisterUserCommand(null, 'username', 'password');
  }

  /** @test */
  public function should_require_username()
  {
    $this->setExpectedException('Assert\AssertionFailedException');

    $command = new RegisterUserCommand('name@domain.com', null, 'password');
  }

  /** @test */
  public function should_require_password()
  {
    $this->setExpectedException('Assert\AssertionFailedException');

    $command = new RegisterUserCommand('name@domain.com', 'username', null);
  }

  /** @test */
  public function should_create_new_register_user_command()
  {
    $command = new RegisterUserCommand('name@domain.com', 'username', 'password');

    $this->assertInstanceOf('Cribbb\Application\Commands\RegisterUserCommand', $command);
    $this->assertEquals('name@domain.com', $command->email);
    $this->assertEquals('username', $command->username);
    $this->assertEquals('password', $command->password);
  }

}
