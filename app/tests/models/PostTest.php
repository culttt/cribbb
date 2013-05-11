<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;

class PostTest extends TestCase {

  /**
   * Test relationship with User
   */
  public function testRelationshipWithUser()
  {
    // Instantiate new Post
    $post = FactoryMuff::create('Post');
   
    // Check that the user_id has been set correctly
    $this->assertEquals($post->user_id, $post->user->id);
  }

  /**
   * Test that user_id is required
   */
  public function testUserIdIsRequired()
  {
    // Create new Post
    $post = new Post;

    // Set the boy
    $post->body = "Yada yada yada";

    // Post should not save
    $this->assertFalse($post->save());

    // Save the errors
    $errors = $post->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The user id field is required.");
  }

  /**
   * Test that Posts' body is required
   */
  public function testPostBodyIsRequired()
  {
    // Create new Post
    $post = new Post;

    // Grab User 1
    $user = FactoryMuff::create('User');

    // Post should not save
    $this->assertFalse($user->posts()->save($post));

    // Save the errors
    $errors = $post->errors()->all();

    // There should be 1 error
    $this->assertCount(1, $errors);

    // The error should be set
    $this->assertEquals($errors[0], "The body field is required.");
  }

  /**
   * Test Post saves correctly
   */
  public function testPostSavesCorrectly()
  {
    // Create a new Post
    $post = FactoryMuff::create('Post');

    // Save the Post
    $this->assertTrue($post->save());
  }

}