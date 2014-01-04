<?php

use Mockery as m;
use Cribbb\Repository\StubRepository;

class RepositoryTest extends TestCase {

  public function tearDown()
  {
    m::close();
  }

  /**
   *  @expectedException Exception
   */
  public function testValidatorThrowsExceptionOnWrongDependency()
  {
    $repository = new StubRepository(new StdClass());
  }

  /**
   *  @expectedException Exception
   */
  public function testCreateMethodThrowsExceptionIfNotArray()
  {
    $repository = new StubRepository(m::mock('Illuminate\Database\Eloquent\Model'));
    $repository->create('hello world');
  }

  /**
   *  @expectedException Exception
   */
  public function testUpdateMethodThrowsExceptionIfNotArray()
  {
    $repository = new StubRepository(m::mock('Illuminate\Database\Eloquent\Model'));
    $repository->update('hello world');
  }

}
