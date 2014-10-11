<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\HashedPassword;

class UserTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserId */
    private $id;

    /** @var Email */
    private $email;

    /** @var Username */
    private $username;

    /** @var HashedPassword */
    private $password;

    public function setUp()
    {
        $this->id       = new UserId(Uuid::uuid4());
        $this->email    = new Email('name@domain.com');
        $this->username = new Username('my_username');
        $this->password = new HashedPassword('super_secret_password');
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
        $user = User::register($this->id, null, $this->username, $this->password);
    }

    /** @test */
    public function should_require_username()
    {
        $this->setExpectedException('Exception');
        $user = User::register($this->id, $this->email, null, $this->password);
    }

    /** @test */
    public function should_require_password()
    {
        $this->setExpectedException('Exception');
        $user = User::register($this->id, $this->email, $this->username, null);
    }

    /** @test */
    public function should_create_new_user()
    {
        $user = User::register($this->id, $this->email, $this->username, $this->password);

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $user);
        $this->assertEquals($this->id,       $user->id());
        $this->assertEquals($this->email,    $user->email());
        $this->assertEquals($this->username, $user->username());
        $this->assertEquals(1, count($user->release()));
    }

    /** @test */
    public function should_update_username()
    {
        $user = User::register($this->id, $this->email, $this->username, $this->password);

        $user->updateUsername(new Username('new_username'));

        $this->assertEquals('new_username', $user->username()->toString());
        $this->count(1, count($user->release()));
    }
}
