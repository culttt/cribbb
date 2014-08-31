<?php namespace Cribbb\Domain\Model\Identity;

use Mockery as m;

class UsernameIsUniqueTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserRepository */
    private $repository;

    /** @var UsernameIsUnique */
    private $spec;

    public function setUp()
    {
        $this->repository = m::mock('Cribbb\Domain\Model\Identity\UserRepository');
        $this->spec = new UsernameIsUnique($this->repository);
    }

    /** @test */
    public function should_return_true_when_unique()
    {
        $this->repository->shouldReceive('userOfUsername')->andReturn(null);
        $this->assertTrue($this->spec->isSatisfiedBy(new Username('430r0923r0209rjw')));
    }

    /** @test */
    public function should_throw_exception_when_not_unique()
    {
        $this->setExpectedException('Cribbb\Domain\Model\Identity\ValueIsNotUniqueException');

        $this->repository->shouldReceive('userOfUsername')->andReturn(['id' => 1]);
        $this->assertFalse($this->spec->isSatisfiedBy(new Username('philipbrown')));
    }
}
