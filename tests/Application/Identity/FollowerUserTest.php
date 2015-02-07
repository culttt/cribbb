<?php namespace Cribbb\Application\Identity;

use Cribbb\Domain\Model\Identity\UserId;

use Mockery as m;
use Cribbb\Application\Identity\FollowUser;
use Cribbb\Domain\Model\Identity\UserRepository;

class FollowUserTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserRepository */
    private $users;

    /** @var FollowUser */
    private $service;

    public function setUp()
    {
        $this->users = m::mock('Cribbb\Domain\Model\Identity\UserRepository');

        $this->service = new FollowUser($this->users);
    }

    /** @test */
    public function should_throw_exception_on_invalid_user_id()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueNotFoundException');

        $this->users->shouldReceive('userById')->once()->andReturn(null);

        $this->service->follow('7c5e8127-3f77-496c-9bb4-5cb092969d89', 'a3d9e532-0ea8-4572-8e83-119fc49e4c6f');
    }

    /** @test */
    public function should_follow_other_user()
    {
        $user = m::mock('Cribbb\Domain\Model\Identity\User');
        $user->shouldReceive('follow')->once();

        $friend = m::mock('Cribbb\Domain\Model\Identity\User');

        $this->users->shouldReceive('userById')->times(2)->andReturn($user, $friend);

        $user = $this->service->follow('7c5e8127-3f77-496c-9bb4-5cb092969d89', 'a3d9e532-0ea8-4572-8e83-119fc49e4c6f');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $user);
    }
}