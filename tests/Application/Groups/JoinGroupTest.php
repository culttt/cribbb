<?php namespace Cribbb\Tests\Application\Groups;

use Mockery as m;
use Cribbb\Application\Groups\JoinGroup;

class JoinGroupTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserRepository */
    private $users;

    /** @var GroupRepository */
    private $groups;

    /** @var JoinGroup */
    private $service;

    public function setUp()
    {
        $this->users  = m::mock('Cribbb\Domain\Model\Identity\UserRepository');
        $this->groups = m::mock('Cribbb\Domain\Model\Groups\GroupRepository');

        $this->service = new JoinGroup($this->users, $this->groups);
    }

    /** @test */
    public function should_throw_exception_on_invalid_user()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueNotFoundException');

        $this->users->shouldReceive('userById')->once()->andReturn(null);

        $this->service->join('7c5e8127-3f77-496c-9bb4-5cb092969d89', 'a3d9e532-0ea8-4572-8e83-119fc49e4c6f');
    }

    /** @test */
    public function should_throw_exception_on_invalid_group()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueNotFoundException');

        $this->users->shouldReceive('userById')->once()->andReturn(true);
        $this->groups->shouldReceive('groupById')->once()->andReturn(null);

        $this->service->join('7c5e8127-3f77-496c-9bb4-5cb092969d89', 'a3d9e532-0ea8-4572-8e83-119fc49e4c6f');
    }

    /** @test */
    public function should_allow_user_to_join_the_group()
    {
        $user  = m::mock('Cribbb\Domain\Model\Identity\User');
        $group = m::mock('Cribbb\Domain\Model\Groups\Group');
        $group->shouldReceive('addMember')->once();

        $this->users->shouldReceive('userById')->once()->andReturn($user);
        $this->groups->shouldReceive('groupById')->once()->andReturn($group);

        $group = $this->service->join('7c5e8127-3f77-496c-9bb4-5cb092969d89', 'a3d9e532-0ea8-4572-8e83-119fc49e4c6f');

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Group', $group);
    }
}