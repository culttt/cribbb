<?php namespace Cribbb\Model\Users;

use Mockery as m;

class UsernameIsUniqueTest extends \PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->repository = m::mock('Cribbb\Model\Users\UserRepository');
    $this->spec = new UsernameIsUnique($this->repository);
  }

  /** @test */
  public function should_return_true_when_unique()
  {
    $this->repository->shouldReceive('findBy')->andReturn(null);
    $this->assertTrue($this->spec->isSatisfiedBy(new Username('430r0923r0209rjw')));
  }

  /** @test */
  public function should_return_false_when_not_unique()
  {
    $this->repository->shouldReceive('findBy')->andReturn(['id' => 1]);
    $this->assertFalse($this->spec->isSatisfiedBy(new Username('philipbrown')));
  }

}
