<?php namespace Cribbb\Domain\Model\Identity;

use Mockery as m;

class EmailIsUniqueTest extends \PHPUnit_Framework_TestCase {

  /** @var UserRepository */
  private $repository;

  /** @var EmailIsUnique */
  private $spec;

  public function setUp()
  {
    $this->repository = m::mock('Cribbb\Domain\Model\Identity\UserRepository');
    $this->spec = new EmailIsUnique($this->repository);
  }

  /** @test */
  public function should_return_true_when_unique()
  {
    $this->repository->shouldReceive('userOfEmail')->andReturn(null);
    $this->assertTrue($this->spec->isSatisfiedBy(new Email('name@domain.com')));
  }

  /** @test */
  public function should_throw_exception_when_not_unique()
  {
    $this->setExpectedException('Cribbb\Domain\Model\Identity\ValueIsNotUniqueException');

    $this->repository->shouldReceive('userOfEmail')->andReturn(['id' => 1]);
    $this->assertFalse($this->spec->isSatisfiedBy(new Email('name@domain.com')));
  }

}
