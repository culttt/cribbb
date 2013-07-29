<?php

class UserControllerTest extends TestCase {

  /**
   * Set up
   */
  public function setUp()
  {
    parent::setUp();

    $this->mock = $this->mock('Cribbb\Storage\User\UserRepository');
  }

  /**
   * Tear down
   */
  public function tearDown()
  {
    Mockery::close();
  }

  /**
   * Mock
   */
  public function mock($class)
  {
    $mock = Mockery::mock($class);

    $this->app->instance($class, $mock);

    return $mock;
  }

  /**
   * Test Index
   */
  public function testIndex()
  {
    $this->mock->shouldReceive('all')->once();

    $this->call('GET', 'users');

    $this->assertResponseOk();
  }

  /**
   * Test Create
   */
  public function testCreate()
  {
    $this->call('GET', 'users/create');

    $this->assertResponseOk();
  }

  /**
   * Test Store fails
   */
  public function testStoreFails()
  {
    $this->mock->shouldReceive('create')
      ->once()
      ->andReturn(Mockery::mock(array('isSaved' => false, 'errors' => array())));

    $this->call('POST', 'users');

    $this->assertRedirectedToRoute('users.create');
    $this->assertSessionHasErrors();
  }

  /**
   * Test Store success
   */
  public function testStoreSuccess()
  {
    $this->mock->shouldReceive('create')
      ->once()
      ->andReturn(Mockery::mock(array('isSaved' => true)));

    $this->call('POST', 'users');

    $this->assertRedirectedToRoute('users.index');
    $this->assertSessionHas('flash');
  }

  /**
   * Test Show
   */
  public function testShow()
  {
    $this->mock->shouldReceive('find')
      ->once()
      ->with(1);

    $this->call('GET', 'users/1');

    $this->assertResponseOk();
  }

  /**
   * Test Edit
   */
  public function testEdit()
  {
    $user = Mockery::self();
    $user->id = 1;

    $this->mock->shouldReceive('find')
      ->once()
      ->with(1)
      ->andReturn($user);

    $this->call('GET', 'users/1/edit');

    $this->assertResponseOk();
  }

  /**
   * Test Update fails
   */
  public function testUpdateFails()
  {
    $this->mock->shouldReceive('update')
      ->once()
      ->with(1)
      ->andReturn(Mockery::mock(array('isSaved' => false, 'errors' => array())));

    $this->call('PUT', 'users/1');

    $this->assertRedirectedToRoute('users.edit', 1);
    $this->assertSessionHasErrors();
  }

  /**
   * Test Update success
   */
  public function testUpdateSuccess()
  {
    $this->mock->shouldReceive('update')
      ->once()
      ->with(1)
      ->andReturn(Mockery::mock(array('isSaved' => true)));

    $this->call('PUT', 'users/1');

    $this->assertRedirectedToRoute('users.show', 1);
    $this->assertSessionHas('flash');
  }

}