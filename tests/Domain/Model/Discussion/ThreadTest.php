<?php namespace Cribbb\Tests\Domain\Model\Discussion;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Model\Discussion\Thread;
use Cribbb\Domain\Model\Discussion\ThreadId;

class ThreadTest extends \PHPUnit_Framework_TestCase
{
    /** @var ThreadId */
    private $id;

    public function setUp()
    {
        $this->id = new ThreadId(Uuid::uuid4());
    }

    /** @test */
    public function should_require_thread_id()
    {
        $this->setExpectedException('Exception');

        $thread = new Thread;
    }

    /** @test */
    public function should_create_new_thread()
    {
        $thread = new Thread($this->id);

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\Thread', $thread);
        $this->assertEquals($this->id, $thread->id());
    }
}
