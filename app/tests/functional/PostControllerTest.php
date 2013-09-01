<?php

class PostControllerTest extends TestCase {

  /**
   * Set up
   */
  public function setUp()
  {
    parent::setUp();

    $this->mock = $this->mock('Cribbb\Storage\Post\PostRepository');
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

    $this->call('GET', 'post');

    $this->assertResponseOk();
  }

  /**
   * Test Create
   */
  public function testCreate()
  {
    $this->call('GET', 'post/create');

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

    $this->call('POST', 'post');

    $this->assertRedirectedToRoute('post.create');
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

    $this->call('POST', 'post');

    $this->assertRedirectedToRoute('home.feed');
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

    $this->call('GET', 'post/1');

    $this->assertResponseOk();
  }

  /**
   * Test Edit
   */
  public function testEdit()
  {
    $post = Mockery::self();
    $post->id = 1;

    $this->mock->shouldReceive('find')
      ->once()
      ->with(1)
      ->andReturn($post);

    $this->call('GET', 'post/1/edit');

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

    $this->call('PUT', 'post/1');

    $this->assertRedirectedToRoute('post.edit', 1);
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

    $this->call('PUT', 'post/1');

    $this->assertRedirectedToRoute('post.show', 1);
    $this->assertSessionHas('flash');
  }

}