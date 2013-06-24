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

  public function testShow()
  {
    $this->mock->shouldReceive('find')
      ->once()
      ->with(1);

    $this->call('GET', 'users/1');

    $this->assertResponseOk();
  }

  public function testEdit()
  {
    $this->call('GET', 'users/1/edit');

    $this->assertResponseOk();
  }

  public function testUpdateFails()
  {
    $this->mock->shouldReceive('update')
      ->once()
      ->with(1)
      ->andReturn(Mockery::mock(array('passes' => false, 'errors' => array())));

    $this->call('PUT', 'users/1');

    $this->assertRedirectedToRoute('users.edit', 1);
    $this->assertSessionHasErrors();
  }

  public function testUpdateSuccess()
  {
    $this->mock->shouldReceive('update')
      ->once()
      ->with(1)
      ->andReturn(Mockery::mock(array('passes' => true)));

    $this->call('PUT', 'users/1');

    $this->assertRedirectedToRoute('users.show', 1);
    $this->assertSessionHas('flash');
  }

}