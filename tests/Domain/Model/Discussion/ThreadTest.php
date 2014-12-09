<?php namespace Cribbb\Tests\Domain\Model\Discussion;

use Cribbb\Domain\Model\Groups\Group;
use Cribbb\Domain\Model\Groups\GroupId;
use Cribbb\Domain\Model\Discussion\Thread;
use Cribbb\Domain\Model\Discussion\ThreadId;

class ThreadTest extends \PHPUnit_Framework_TestCase
{
    /** @var Group */
    private $group;

    public function setUp()
    {
        $this->group = new Group(GroupId::generate(), 'Cribbb');
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
}
