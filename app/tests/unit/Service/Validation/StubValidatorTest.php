<?php

use Mockery as m;
use Cribbb\Service\Validation\StubValidator;

class StubValidationTest extends TestCase {

  public function tearDown()
  {
    m::close();
  }

  /**
   *  @expectedException Exception
   */
  public function testCreateValidatorWithMethodThrowsExceptionIfNotArray()
  {
    $validator = new StubValidator;
    $validator->with('hello world');
  }

}
