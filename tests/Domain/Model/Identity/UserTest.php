<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Groups\GroupId;
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
        $this->id       = UserId::generate();
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

    /** @test */
    public function should_follow_and_have_followers()
    {
        $user1 = User::register(
            UserId::generate(),
            new Email('jack@twitter.com'),
            new Username('jack'),
            new HashedPassword('square')
        );

        $user2 = User::register(
            UserId::generate(),
            new Email('ev@twitter.com'),
            new Username('ev'),
            new HashedPassword('medium')
        );

        $user3 = User::register(
            UserId::generate(),
            new Email('biz@twitter.com'),
            new Username('biz'),
            new HashedPassword('jelly')
        );

        $user4 = User::register(
            UserId::generate(),
            new Email('dick@twitter.com'),
            new Username('dick'),
            new HashedPassword('feedburner')
        );

        $user2->follow($user3);
        $user2->follow($user4);
        $user3->follow($user4);
        $user4->follow($user1);
        $user4->follow($user2);
        $user4->follow($user3);

        $this->assertEquals(1, $user1->followers()->count());
        $this->assertEquals(0, $user1->following()->count());
        $this->assertEquals(1, $user2->followers()->count());
        $this->assertEquals(2, $user2->following()->count());
        $this->assertEquals(2, $user3->followers()->count());
        $this->assertEquals(1, $user3->following()->count());
        $this->assertEquals(2, $user4->followers()->count());
        $this->assertEquals(3, $user4->following()->count());

        $user2->unfollow($user3);
        $user4->unfollow($user3);

        $this->assertEquals(1, $user1->followers()->count());
        $this->assertEquals(0, $user1->following()->count());
        $this->assertEquals(1, $user2->followers()->count());
        $this->assertEquals(1, $user2->following()->count());
        $this->assertEquals(0, $user3->followers()->count());
        $this->assertEquals(1, $user3->following()->count());
        $this->assertEquals(2, $user4->followers()->count());
        $this->assertEquals(2, $user4->following()->count());
    }

    /** @test */
    public function should_become_a_member_of_a_group()
    {
        $user = User::register(
            UserId::generate(),
            new Email('zuck@facebook.com'),
            new Username('zuck'),
            new HashedPassword('facemash')
        );

        $group = new Group(GroupId::generate(), 'Porcellian');

        $this->assertEquals(0, $group->members()->count());
        $this->assertEquals(0, $user->memberOf()->count());

        $user->addAsMemberOf($group);

        $this->assertEquals(1, $group->members()->count());
        $this->assertEquals(1, $user->memberOf()->count());
    }

    /** @test */
    public function should_become_an_admin_of_a_group()
    {
        $user = User::register(
            UserId::generate(),
            new Email('zuck@facebook.com'),
            new Username('zuck'),
            new HashedPassword('facemash')
        );

        $group = new Group(GroupId::generate(), 'Porcellian');

        $this->assertEquals(0, $group->admins()->count());
        $this->assertEquals(0, $user->adminOf()->count());

        $user->addAsAdminOf($group);

        $this->assertEquals(1, $group->admins()->count());
        $this->assertEquals(1, $user->adminOf()->count());
    }
}
