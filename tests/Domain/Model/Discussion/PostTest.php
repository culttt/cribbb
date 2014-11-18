<?php namespace Cribbb\Tests\Domain\Model\Discussion;

use Rhumsaa\Uuid\Uuid;
use Cribbb\Domain\Model\Discussion\Post;
use Cribbb\Domain\Model\Discussion\PostId;

class PostTest extends \PHPUnit_Framework_TestCase
{
    /** @var PostId */
    private $id;

    /** @var string */
    private $body;

    public function setUp()
    {
        $this->id   = new PostId(Uuid::uuid4());
        $this->body = '...';
    }

    /** @test */
    public function should_require_post_id()
    {
        $this->setExpectedException('Exception');

        $post = new Post(null, $this->name, $this->slug);
    }

    /** @test */
    public function should_require_body()
    {
        $this->setExpectedException('Exception');

        $post = new Post($this->id, null);
    }

    /** @test */
    public function should_create_new_group()
    {
        $post = new Post($this->id, $this->body);

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\Post', $post);
        $this->assertEquals($this->id,   $post->id());
        $this->assertEquals($this->body, $post->body());
    }
}
