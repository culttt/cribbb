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

  public function testRelationshipWithUser()
  {
    $post = FactoryMuff::create('Post');

    $this->assertEquals( $post->user_id, $post->user->id );
  }

}