<?php namespace Cribbb\Repositories\Post;

interface PostRepository {

  /**
   * Feed
   *
   * @param int $id
   * @return object
   */
  public function feed($id);

}
