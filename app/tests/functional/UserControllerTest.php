<?php

class UserControllerTest extends TestCase {

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

    $this->call('GET', 'user');

    $this->assertResponseOk();
  }

}