<?php namespace Cribbb\Repository\User;

use Illuminate\Database\Eloquent\Model;
use Cribbb\Repository\Post\PostRepository;

class EloquentUser implements UserRepository {

  /**
   * @var Model
   */
  protected $user;

  /**
   * Construct
   *
   * @param Model $user
   * @param PostRepository $post
   */
  public function __construct(Model $user, PostRepository $post)
  {
    $this->user = $user;
    $this->post = $post;
  }

  /**
   * All
   *
   * @return Model
   */
  public function all()
  {
    return $this->user->all();
  }

  /**
   * Find
   *
   * @param int $id
   * @return Model
   */
  public function find($id)
  {
    return $this->user->find($id);
  }

  /**
   * Create
   *
   * @param array $data
   * @return boolean
   */
  public function create(array $data)
  {

  }

  /**
   * Update
   *
   * @param array $data
   * @return boolean
   */
  public function update(array $data)
  {

  }

  /**
   * Delete
   *
   * @param int $id
   * @return boolean
   */
  public function delete($id)
  {
    $user = $this>find($id);

    return $user->delete();
  }

  /**
   * Feed
   *
   * @param int $id
   * @return PostRepository
   */
  public function feed($id)
  {
    return $this->post->getUserFeed($id);
  }

}
