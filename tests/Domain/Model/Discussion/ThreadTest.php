<?php namespace Cribbb\Tests\Domain\Model\Discussion;

use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\HashedPassword;

use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Groups\GroupId;
use Cribbb\Domain\Model\Discussion\Thread;
use Cribbb\Domain\Model\Discussion\ThreadId;

class ThreadTest extends \PHPUnit_Framework_TestCase
{
    /** @var Group */
    private $group;

    /** @var User */
    private $user;

    public function setUp()
    {
        $this->group = new Group(GroupId::generate(), 'Cribbb');

        $this->user = User::register(
            UserId::generate(),
            new Email('name@domain.com'),
            new Username('username'),
            new HashedPassword('password')
        );
    }

    /** @test */
    public function should_require_id()
    {
        $this->setExpectedException('Exception');

        $thread = new Thread(null, 'Hello World', $this->group);
    }

    /** @test */
    public function should_require_subject()
    {
        $this->setExpectedException('Exception');

        $thread = new Thread(ThreadId::generate(), null, $this->group);
    }

    /** @test */
    public function should_require_group()
    {
        $this->setExpectedException('Exception');

        $thread = new Thread(ThreadId::generate(), 'Hello World');
    }

    /** @test */
    public function should_create_thread()
    {
        $thread = new Thread(ThreadId::generate(), 'Hello World', $this->group);

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\Thread', $thread);
        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\ThreadId', $thread->id());
        $this->assertEquals('Hello World', $thread->subject());
        $this->assertEquals('hello-world', $thread->slug());
        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Group', $thread->group());
    }

    /** @test */
    public function should_fail_to_create_post_when_user_is_not_a_member()
    {
        $this->setExpectedException('Exception');

        $thread = new Thread(ThreadId::generate(), 'Hello World', $this->group);

        $post = $thread->createNewPost($this->user, 'Once upon a time...');

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\Post', $post);
    }

    /** @test */
    public function should_create_post()
    {
        $this->group->addMember($this->user);

        $thread = new Thread(ThreadId::generate(), 'Hello World', $this->group);

        $post = $thread->createNewPost($this->user, 'Once upon a time...');

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\Post', $post);
    }
}
