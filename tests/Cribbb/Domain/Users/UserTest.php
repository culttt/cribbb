<?php namespace Cribbb\Domain\Users;

use Cribbb\Domain\Users\Email;
use Cribbb\Domain\Users\Username;
use Cribbb\Domain\Users\Password;

class UserTest extends \PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->email = new Email('name@domain.com');
    $this->username = new Username('my_username');
    $this->password = new Password('super_secret_password');
  }

  /** @test */
  public function should_require_email()
  {
    $this->setExpectedException('Exception');
    $user = new User(null, $this->username, $this->password);
  }

  /** @test */
  public function should_require_username()
  {
    $this->setExpectedException('Exception');
    $user = new User($this->email, null, $this->password);
  }

  /** @test */
  public function should_require_password()
  {
    $this->setExpectedException('Exception');
    $user = new User($this->email, $this->username, null);
  }

  /** @test */
  public function should_create_new_user()
  {
    $user = new User($this->email, $this->username, $this->password);
    $this->assertInstanceOf('Cribbb\Domain\Users\User', $user);

    $this->assertEquals($user->getEmail(), 'name@domain.com');
    $this->assertEquals($user->getUsername(), 'my_username');
    $this->assertEquals($user->getPassword(), 'super_secret_password');
  }

}
