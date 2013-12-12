<?php

use Cribbb\Service\Validation\Laravel\StubValidator;

class UserValidatorTest extends TestCase {

  public function testCreateSuccess()
  {
    $stub = new StubValidator( App::make('validator') );
    $this->assertTrue( $stub->with( $this->getValidCreateData() )->canCreate() );
  }

  public function testCreateFailure()
  {
    $stub = new StubValidator( App::make('validator') );
    $this->assertFalse( $stub->with( $this->getInvalidCreateData() )->canCreate() );
    $this->assertEquals(3, count($stub->errors()));
    $this->assertInstanceOf('Illuminate\Support\MessageBag', $stub->errors());
  }

  public function getValidCreateData()
  {
    return array(
      'username' => 'philipbrown',
      'email' => 'phil@ipbrown.com',
      'password' => 'totes_secure_password',
      'password_confirmation' => 'totes_secure_password'
    );
  }

  public function getInvalidCreateData()
  {
    return array(
      'username' => '<@)}}}><{',
      'email' => 'this is not an email',
      'password' => 'totes_secure_password',
      'password_confirmation' => 'blah_blah_blah'
    );
  }

}
