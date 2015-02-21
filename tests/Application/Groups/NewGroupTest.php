<?php namespace Cribbb\Tests\Application\Groups;

use Mockery as m;
use Cribbb\Application\Groups\NewGroup;
use Cribbb\Domain\Model\Identity\UserRepository;
use Cribbb\Domain\Services\Groups\NewGroupService;

class NewGroupTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserRepository */
    private $users;

    /** @var GroupRepository */
    private $groups;

    /** @var NewGroup */
    private $service;

    public function setUp()
    {
        $this->users  = m::mock('Cribbb\Domain\Model\Identity\UserRepository');
        $this->groups = m::mock('Cribbb\Domain\Model\Groups\GroupRepository');

        $this->service = new NewGroup($this->users, new NewGroupService($this->groups));
    }

    /** @test */
    public function should_throw_exception_on_invalid_user_id()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueNotFoundException');

        $this->users->shouldReceive('userById')->once()->andReturn(null);

        $this->service->create('7c5e8127-3f77-496c-9bb4-5cb092969d89', 'Cribbb');
    }

    /** @test */
    public function should_create_new_group()
    {
        $user = m::mock('Cribbb\Domain\Model\Identity\User');

        $this->users->shouldReceive('userById')->once()->andReturn($user);

        $this->groups->shouldReceive('groupOfName')->once()->andReturn(null);
        $this->groups->shouldReceive('add')->once();

        $group = $this->service->create('7c5e8127-3f77-496c-9bb4-5cb092969d89', 'Cribbb');

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Group', $group);
    }
}