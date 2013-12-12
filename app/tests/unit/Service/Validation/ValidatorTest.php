<?php

use Mockery as m;
use Cribbb\Service\Validation\Laravel\UserValidator;

class ValidatorTest extends TestCase {

  public function tearDown()
  {
    m::close();
  }

  /**
   *  @expectedException Exception
   */
  public function testValidatorThrowsExceptionOnWrongDependency()
  {
    $validator = new UserValidator( new StdClass() );
  }

  /**
   *  @expectedException Exception
   */
  public function testWithMethodThrowsExceptionIfNotArray()
  {
    $validator = new UserValidator( m::mock('Illuminate\Validation\Factory') );

    $validator->with( 'hello world' );
  }

  /**
   *  @expectedException Exception
   */
  public function testPassesMethodThrowsExceptionIfNotArray()
  {
    $validator = new UserValidator( m::mock('Illuminate\Validation\Factory') );

    $validator->passes( 'hello world' );
  }

}
