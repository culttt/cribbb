<?php

use Mockery as m;
use Cribbb\Validators\User\UserCreateValidator;

class ValidatorTest extends TestCase {

  public function setUp()
  {
    parent::setUp();

    $this->v = App::make('Cribbb\Validators\User\UserUpdateValidator');
  }

  public function tearDown()
  {
    m::close();
  }

  /**
   * @expectedException Exception
   */
  public function testLaravelValidatorRequiresFactoryDependency()
  {
    $v = new UserCreateValidator( new StdClass );
  }

  /**
   * @expectedException Exception
   */
  public function testCreateValidatorWithMethodThrowsExceptionIfNotArray()
  {
    $this->v->with('hello world');
  }

  public function testReplaceMethod()
  {
    $this->v->with($this->getValidCreateData());
    $rules = $this->v->replace();
    $this->assertEquals('required|email|unique:users,email,3', $rules['email']);
  }

  protected function getValidCreateData()
  {
    return array(
      'id'        => '3',
      'email'     => 'email@domain.com',
      'password'  => '1234'
    );
  }

}
