<?php namespace Cribbb\Tests\Application\Groups;

use Mockery as m;
use Cribbb\Application\Groups\FindGroupBySlug;

class FindGroupBySlugTest extends \PHPUnit_Framework_TestCase
{
    /** @var GroupRepository */
    private $groups;

    /** @var FindGrouBySlug */
    private $service;

    public function setUp()
    {
        $this->groups = m::mock('Cribbb\Domain\Model\Groups\GroupRepository');

        $this->service = new FindGroupBySlug($this->groups);
    }

    /** @test */
    public function should_throw_exception_on_invalid_slug()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueNotFoundException');

        $this->groups->shouldReceive('groupBySlug')->once()->andReturn(null);

        $this->service->find('cribbb');
    }

    /** @test */
    public function should_find_group()
    {
        $group = m::mock('Cribbb\Domain\Model\Groups\Group');

        $this->groups->shouldReceive('groupBySlug')->once()->andReturn($group);

        $group = $this->service->find('cribbb');

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Group', $group);
    }
}