<?php namespace Cribbb\Storage\Post;

interface PostRepository {

  /**
   * Get User Feed
   *
   * @param int $id
   * @return object
   */
  public function getUserFeed($id);

}
