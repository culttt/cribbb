<?php

use Mockery as m;
use Cribbb\Repositories\User\EloquentUserRepository;

class UserRepositoryTest extends TestCase {

  public function setUp()
  {
    parent::setUp();

    $this->r = App::make('Cribbb\Repositories\User\UserRepository');
  }

  public function tearDown()
  {
    m::close();
  }

  public function testUserRepositoryIsErrorsIsMessageBag()
  {
    $r = new EloquentUserRepository(m::mock('Illuminate\Database\Eloquent\Model'), App::make('Cribbb\Repositories\Post\PostRepository'));
    $this->assertInstanceOf('Illuminate\Support\MessageBag', $r->errors());
  }

  /**
   * @expectedException Exception
   */
  public function testUserRepositoryRequiresModel()
  {
    $r = new EloquentUserRepository(array(), App::make('Cribbb\Repositories\Post\PostRepository'));
  }

  /**
   * @expectedException Exception
   */
  public function testUserRepositoryRequiresPostRepository()
  {
    $r = new EloquentUserRepository(m::mock('Illuminate\Database\Eloquent\Model'), array());
  }

  /**
   * @expectedException Exception
   */
  public function testUserRepositoryCreateMethodOnlyAcceptsArray()
  {
    $this->r->create('hello world');
  }

  /**
   * @expectedException Exception
   */
  public function testUserRepositoryUpdateMethodOnlyAcceptsArray()
  {
    $this->r->update('hello world');
  }

}
