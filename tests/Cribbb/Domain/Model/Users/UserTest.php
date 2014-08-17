<?php namespace Cribbb\Domain\Model\Users;

use Rhumsaa\Uuid\Uuid;

class UserTest extends \PHPUnit_Framework_TestCase {

  /** @var UserId */
  private $userId;

  /** @var Email */
  private $email;

  /** @var Username */
  private $username;

  /** @var Password */
  private $password;

  public function setUp()
  {
    $this->userId = new UserId(Uuid::uuid4());
    $this->email = new Email('name@domain.com');
    $this->username = new Username('my_username');
    $this->password = new Password('super_secret_password');
  }

  /** @test */
  public function should_require_user_id()
  {
    $this->setExpectedException('Exception');

    $user = User::register(null, $this->email, $this->username, $this->password);
  }

  /** @test */
  public function should_require_email()
  {
    $this->setExpectedException('Exception');
    $user = User::register($this->userId, null, $this->username, $this->password);
  }

  /** @test */
  public function should_require_username()
  {
    $this->setExpectedException('Exception');
    $user = User::register($this->userId, $this->email, null, $this->password);
  }

  /** @test */
  public function should_require_password()
  {
    $this->setExpectedException('Exception');
    $user = User::register($this->userId, $this->email, $this->username, null);
  }

  /** @test */
  public function should_create_new_user()
  {
    $user = User::register($this->userId, $this->email, $this->username, $this->password);

    $this->assertInstanceOf('Cribbb\Domain\Model\Users\User', $user);
    $this->assertInstanceOf('Cribbb\Domain\Model\Users\UserId', $user->id());
    $this->assertEquals($user->email(), 'name@domain.com');
    $this->assertEquals($user->username(), 'my_username');
  }

}
