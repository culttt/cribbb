<?php namespace Cribbb\Tests\Domain\Model\Discussion;

use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Groups\GroupId;
use Cribbb\Domain\Model\Discussion\Post;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Discussion\PostId;
use Cribbb\Domain\Model\Discussion\Thread;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Discussion\ThreadId;
use Cribbb\Domain\Model\Identity\HashedPassword;

class PostTest extends \PHPUnit_Framework_TestCase
{
    /** @var User */
    private $user;

    /** @var Thread */
    private $thread;

    public function setUp()
    {
        $this->user = User::register(
            UserId::generate(),
            new Email('name@domain.com'),
            new Username('username'),
            new HashedPassword('password')
        );

        $this->thread = new Thread(
            ThreadId::generate(),
            new Group(GroupId::generate(), 'Cribbb'),
            'Hello World'
        );
    }

    /** @test */
    public function should_require_id()
    {
        $this->setExpectedException('Exception');

        $post = new Post(null, $this->user, $this->thread, 'Once upon a time...');
    }

    /** @test */
    public function should_require_user()
    {
        $this->setExpectedException('Exception');

        $post = new Post(PostId::generate(), null, $this->thread, 'Once upon a time...');
    }

    /** @test */
    public function should_require_thread()
    {
        $this->setExpectedException('Exception');

        $post = new Post(PostId::generate(), $this->user, null, 'Once upon a time...');
    }

    /** @test */
    public function should_require_body()
    {
        $this->setExpectedException('Exception');

        $post = new Post(PostId::generate(), $this->user, $this->thread);
    }

    /** @test */
    public function should_create_post()
    {
        $post = new Post(PostId::generate(), $this->user, $this->thread, 'Once upon a time...');

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\Post', $post);
        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\PostId', $post->id());
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $post->user());
        $this->assertInstanceOf('Carbon\Carbon', $post->createdAt());
        $this->assertEquals('Once upon a time...', $post->body());
    }
}
