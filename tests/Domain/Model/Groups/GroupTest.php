<?php namespace Cribbb\Tests\Domain\Model\Groups;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Groups\GroupId;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\HashedPassword;

class GroupTest extends \PHPUnit_Framework_TestCase
{
    /** @var User */
    private $user;

    public function setUp()
    {
        $this->user = User::register(
            UserId::generate(),
            new Email('name@domain.com'),
            new Username('username'),
            new HashedPassword('password')
        );
    }

    /** @test */
    public function should_require_group_id()
    {
        $this->setExpectedException('Exception');

        $group = new Group(null, 'Cribbb');
    }

    /** @test */
    public function should_require_name()
    {
        $this->setExpectedException('Exception');

        $group = new Group(GroupId::generate(), null);
    }

    /** @test */
    public function should_create_new_group()
    {
        $group = new Group(GroupId::generate(), 'Cribbb');

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Group', $group);
        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\GroupId', $group->id());
        $this->assertEquals('Cribbb', $group->name());
        $this->assertEquals('cribbb', $group->slug());
    }

    /** @test */
    public function should_have_members_collection()
    {
        $group = new Group(GroupId::generate(), 'Cribbb');
        $group->addMember($this->user);

        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $group->members());
        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Member', $group->members()->first());
    }

    /** @test */
    public function should_have_admins_collection()
    {
        $group = new Group(GroupId::generate(), 'Cribbb');
        $group->addAdmin($this->user);

        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $group->admins());
        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Admin', $group->admins()->first());
    }

    /** @test */
    public function should_check_to_see_if_user_is_member()
    {
        $group = new Group(GroupId::generate(), 'Cribbb');

        $this->assertFalse($group->isMember($this->user));

        $group->addMember($this->user);

        $this->assertTrue($group->isMember($this->user));
    }

    /** @test */
    public function should_check_to_see_if_user_is_admin()
    {
        $group = new Group(GroupId::generate(), 'Cribbb');

        $this->assertFalse($group->isAdmin($this->user));

        $group->addAdmin($this->user);

        $this->assertTrue($group->isAdmin($this->user));
    }

    /** @test */
    public function should_create_a_new_thread()
    {
        $group = new Group(GroupId::generate(), 'Cribbb');
        $group->addMember($this->user);
        $thread = $group->startNewThread($this->user, 'Hello World');

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\Thread', $thread);
        $this->assertEquals(1, $group->threads()->count());
    }

    /** @test */
    public function should_throw_exception_when_non_member_attempts_to_create_thread()
    {
        $this->setExpectedException('Exception');

        $group = new Group(GroupId::generate(), 'Cribbb');
        $thread = $group->startNewThread($this->user, 'Hello World');
    }
}
