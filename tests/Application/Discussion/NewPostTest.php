<?php namespace Cribbb\Tests\Application\Discussion;

use Mockery as m;
use Cribbb\Application\Discussion\NewPost;

class NewPostTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserRepository */
    private $users;

    /** @var ThreadRepository */
    private $threads;

    /** @var PostRepository */
    private $posts;

    /** @var NewPost */
    private $service;

    public function setUp()
    {
        $this->users   = m::mock('Cribbb\Domain\Model\Identity\UserRepository');
        $this->threads = m::mock('Cribbb\Domain\Model\Discussion\ThreadRepository');
        $this->posts   = m::mock('Cribbb\Domain\Model\Discussion\PostRepository');

        $this->service = new NewPost($this->users, $this->threads, $this->posts);
    }

    /** @test */
    public function should_throw_exception_on_invalid_user_id()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueNotFoundException');

        $this->users->shouldReceive('userById')->once()->andReturn(null);

        $this->service->create(
            '7c5e8127-3f77-496c-9bb4-5cb092969d89',
            'a3d9e532-0ea8-4572-8e83-119fc49e4c6f',
            'Hello World');
    }

    /** @test */
    public function should_throw_exception_on_invalid_thread_id()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueNotFoundException');

        $this->users->shouldReceive('userById')->once()->andReturn(true);
        $this->threads->shouldReceive('threadById')->once()->andReturn(null);

        $this->service->create(
            '7c5e8127-3f77-496c-9bb4-5cb092969d89',
            'a3d9e532-0ea8-4572-8e83-119fc49e4c6f',
            'hello world');
    }

    /** @test */
    public function should_create_new_post()
    {
        $user   = m::mock('Cribbb\Domain\Model\Identity\User');
        $thread = m::mock('Cribbb\Domain\Model\Discussion\Thread');
        $post   = m::mock('Cribbb\Domain\Model\Discussion\Post');

        $this->users->shouldReceive('userById')->once()->andReturn($user);
        $this->threads->shouldReceive('threadById')->once()->andReturn($thread);

        $thread->shouldReceive('createNewPost')->once()->andReturn($post);

        $this->posts->shouldReceive('add')->once();

        $post = $this->service->create(
            '7c5e8127-3f77-496c-9bb4-5cb092969d89',
            'a3d9e532-0ea8-4572-8e83-119fc49e4c6f',
            'Hello World');

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\Post', $post);
    }
}