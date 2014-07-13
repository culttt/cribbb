<?php namespace Cribbb\Users;

use Cribbb\Users\Email\Email;
use Cribbb\Users\Username\Username;
use Cribbb\Users\Password\Password;

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
    $this->assertInstanceOf('Cribbb\Users\User', $user);
  }

}
