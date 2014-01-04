<?php

use Cribbb\Service\Validation\Laravel\StubValidator;

class LaravelValidatorTest extends TestCase {

  public function testCreateSuccess()
  {
    $stub = new StubValidator( App::make('validator') );
    $this->assertTrue( $stub->with( $this->getValidCreateData() )->passes() );
  }

  public function testCreateFailure()
  {
    $stub = new StubValidator( App::make('validator') );
    $this->assertFalse( $stub->with( $this->getInvalidCreateData() )->passes() );
    $this->assertEquals(2, count($stub->errors()));
    $this->assertInstanceOf('Illuminate\Support\MessageBag', $stub->errors());
  }

  public function testReplaceMethod()
  {
    $stub = new StubValidator ( App::make('validator') );
    $stub->with($this->getInvalidCreateData());
    $rules = $stub->replace();
    $this->assertEquals('required|email|unique:users,email,6', $rules['email']);
  }

  public function getValidCreateData()
  {
    return array(
      'id' => '6',
      'email' => 'phil@ipbrown.com',
      'password' => '1234'
    );
  }

  public function getInvalidCreateData()
  {
    return array(
      'id' => '6',
      'email' => 'not_an_email',
      'password' => ''
    );
  }

}
