<?php

class UsersControllerTest extends TestCase {

  public function setUp()
  {
    parent::setUp();

    $this->mock = $this->mock('Cribbb\Storage\User\UserRepository');
  }

  public function tearDown()
  {
    Mockery::close();
  }

  public function mock($class)
  {
    $mock = Mockery::mock($class);

    $this->app->instance($class, $mock);

    return $mock;
  }

  public function testIndex()
  {
    $this->mock->shouldReceive('all')->once();

    $this->call('GET', 'users');

    $this->assertResponseOk();
  }

  public function testCreate()
  {
    $this->call('GET', 'users/create');

    $this->assertResponseOk();
  }

  public function testStoreFails()
  {
    $this->mock->shouldReceive('create')
      ->once()
      ->andReturn(Mockery::mock(array('passes' => false, 'errors' => array())));

    $this->call('POST', 'users');

    $this->assertRedirectedToRoute('users.create');
    $this->assertSessionHasErrors();
  }

  public function testStoreSuccess()
  {
    $this->mock->shouldReceive('create')
      ->once()
      ->andReturn(Mockery::mock(array('passes' => true)));

    $this->call('POST', 'users');

    $this->assertRedirectedToRoute('users.index');
    $this->assertSessionHas('flash');
  }

}