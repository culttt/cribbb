<?php namespace Cribbb\Domain\Model\Users;

use Mockery as m;

class EmailIsUniqueTest extends \PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->repository = m::mock('Cribbb\Domain\Model\Users\UserRepository');
    $this->spec = new EmailIsUnique($this->repository);
  }

  /** @test */
  public function should_return_true_when_unique()
  {
    $this->repository->shouldReceive('findBy')->andReturn(null);
    $this->assertTrue($this->spec->isSatisfiedBy(new Email('name@domain.com')));
  }

  /** @test */
  public function should_return_false_when_not_unique()
  {
    $this->repository->shouldReceive('findBy')->andReturn(['id' => 1]);
    $this->assertFalse($this->spec->isSatisfiedBy(new Email('name@domain.com')));
  }

}
