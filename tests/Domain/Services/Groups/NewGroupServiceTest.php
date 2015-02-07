<?php namespace Cribbb\Tests\Domain\Services\Groups;

use Mockery as m;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Groups\GroupRepository;
use Cribbb\Domain\Services\Groups\NewGroupService;

class NewGroupServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var User */
    private $user;

    /** @var NewGroupService */
    private $service;

    /** @var GroupRepository */
    private $groups;

    public function setUp()
    {
        $this->user   = m::mock('Cribbb\Domain\Model\Identity\User');
        $this->groups = m::mock('Cribbb\Domain\Model\Groups\GroupRepository');

        $this->service = new NewGroupService($this->groups);
    }

    /** @test */
    public function should_throw_exection_if_user_is_not_valid()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueIsNotUniqueException');

        $this->groups->shouldReceive('groupOfName')->once()->andReturn(true);

        $this->service->create($this->user, 'Cribbb');
    }

    /** @test */
    public function should_create_new_group()
    {
        $this->groups->shouldReceive('groupOfName')->once()->andReturn(null);
        $this->groups->shouldReceive('add')->once()->andReturn(null);
        $this->user->shouldReceive('id')->once()->andReturn(UserId::generate());
        $this->user->shouldReceive('email')->once()->andReturn(new Email('name@domain.com'));
        $this->user->shouldReceive('username')->once()->andReturn(new Username('username'));

        $group = $this->service->create($this->user, 'Cribbb');

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Group', $group);
        $this->assertEquals('Cribbb', $group->name());
        $this->assertEquals(1, $group->admins()->count());
    }
}