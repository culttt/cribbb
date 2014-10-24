<?php namespace Cribbb\Tests\Domain\Model\Groups;

use Mockery as m;
use Cribbb\Domain\Model\Groups\Name;
use Cribbb\Domain\Model\Groups\NameIsUnique;

class NameIsUniqueTest extends \PHPUnit_Framework_TestCase
{
    /** @var GroupRepository */
    private $repository;

    /** @var NameIsUnique */
    private $spec;

    public function setUp()
    {
        $this->repository = m::mock('Cribbb\Domain\Model\Groups\GroupRepository');
        $this->spec = new NameIsUnique($this->repository);
    }

    /** @test */
    public function should_return_true_when_unique()
    {
        $this->repository->shouldReceive('groupOfName')->andReturn(null);
        $this->assertTrue($this->spec->isSatisfiedBy(new Name('Cribbb')));
    }

    /** @test */
    public function should_return_false_when_not_unique()
    {
        $this->repository->shouldReceive('groupOfName')->andReturn(['id' => 1]);
        $this->assertFalse($this->spec->isSatisfiedBy(new Name('Cribbb')));
    }
}
