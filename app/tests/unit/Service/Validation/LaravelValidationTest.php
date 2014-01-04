<?php

use Mockery as m;
use Cribbb\Service\Validation\Laravel\StubValidator;

class LaravelValidationTest extends TestCase {

  public function tearDown()
  {
    m::close();
  }

  /**
   *  @expectedException Exception
   */
  public function testCreateValidatorThrowsExceptionOnWrongDependency()
  {
    $validator = new StubValidator(new StdClass());
  }

  /**
   *  @expectedException Exception
   */
  public function testCreateValidatorWithMethodThrowsExceptionIfNotArray()
  {
    $validator = new StubValidator(m::mock('Illuminate\Validation\Factory'));
    $validator->with('hello world');
  }

}
