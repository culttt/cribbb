<?php

/*
class SessionControllerTest extends TestCase{

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

  public function testCreate()
  {
    $this->call('GET', 'login');

    $this->assertResponseOk();
  }

  public function testStoreFailure()
  {
    Auth::shouldReceive('attempt')->andReturn(false);

    $this->call('POST', 'login');

    $this->assertRedirectedToRoute('session.create');
    $this->assertSessionHas('flash');
  }

  public function testStoreSuccess()
  {
    Auth::shouldReceive('attempt')->andReturn(true);

    $this->call('POST', 'login');

    $this->assertRedirectedToRoute('home.feed');
  }

}
*/
