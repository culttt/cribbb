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

    // Create a new user
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

  /**
   *  Test adding new comment
   */
  public function testAddingNewComment()
  {
    // Create a new Post
    $post = FactoryMuff::create('Post');

    // Create a new Comment
    $comment = new Comment(array('body' => 'A new comment.'));

    // Save the Comment to the Post
    $post->comments()->save($comment);

    // This Post should have one comment
    $this->assertCount(1, $post->comments);
  }

}