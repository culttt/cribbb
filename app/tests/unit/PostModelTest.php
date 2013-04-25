<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;

class PostModelTest extends TestCase {

  /**
   * Test the body is required
   */
  public function testBodyIsRequired()
  {
    $post = new Post;

    $this->assertFalse( $post->save() );
  }

  /**
   * Test that a Post belongs to a User
   */
  public function testRelationshipWithUser()
  {
    $post = FactoryMuff::create('Post');

    $this->assertEquals( $post->user_id, $post->user->id );
  }

}