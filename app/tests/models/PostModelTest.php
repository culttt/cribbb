<?php

class PostModelTest extends TestCase {

  /**
   * Test the body is required
   */
  public function testBodyIsRequired()
  {
    $post = new Post;

    $this->assertFalse($post->save());
  }

}