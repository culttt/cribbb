<?php namespace Cribbb\Tests\Application\Discussion;

use Mockery as m;
use Cribbb\Application\Discussion\NewThread;

class NewThreadTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserRepository */
    private $users;

    /** @var GroupRepository */
    private $groups;

    /** @var ThreadRepository */
    private $threads;

    /** @var NewThread */
    private $service;

    public function setUp()
    {
        $this->users   = m::mock('Cribbb\Domain\Model\Identity\UserRepository');
        $this->groups  = m::mock('Cribbb\Domain\Model\Groups\GroupRepository');
        $this->threads = m::mock('Cribbb\Domain\Model\Discussion\ThreadRepository');

        $this->service = new NewThread($this->users, $this->groups, $this->threads);
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
    public function should_throw_exception_on_invalid_group_id()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueNotFoundException');

        $this->users->shouldReceive('userById')->once()->andReturn(true);
        $this->groups->shouldReceive('groupById')->once()->andReturn(null);

        $this->service->create(
            '7c5e8127-3f77-496c-9bb4-5cb092969d89',
            'a3d9e532-0ea8-4572-8e83-119fc49e4c6f',
            'hello world');
    }

    /** @test */
    public function should_create_new_thread()
    {
        $user   = m::mock('Cribbb\Domain\Model\Identity\User');
        $group  = m::mock('Cribbb\Domain\Model\Groups\Group');
        $thread = m::mock('Cribbb\Domain\Model\Discussion\Thread');

        $this->users->shouldReceive('userById')->once()->andReturn($user);
        $this->groups->shouldReceive('groupById')->once()->andReturn($group);

        $group->shouldReceive('startNewThread')->once()->andReturn($thread);

        $this->threads->shouldReceive('add')->once();

        $thread = $this->service->create(
            '7c5e8127-3f77-496c-9bb4-5cb092969d89',
            'a3d9e532-0ea8-4572-8e83-119fc49e4c6f',
            'Hello World');

        $this->assertInstanceOf('Cribbb\Domain\Model\Discussion\Thread', $thread);
    }
}