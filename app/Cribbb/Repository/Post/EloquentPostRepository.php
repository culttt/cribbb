<?php namespace Cribbb\Repository\Post;

use Illuminate\Database\Eloquent\Model;
use Cribbb\Repository\RepositoryInterface;

class EloquentPostRepository implements RepositoryInterface, PostRepository {

  /**
   * @var $post
   */
  protected $post;

  /**
   * Construct
   *
   * @param Illuminate\Database\Eloquent\Model $post
   */
  public function __construct(Model $post)
  {
    $this->post = $post;
  }

  /**
   * All
   *
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all()
  {
    return $this->post->all();
  }

  /**
   * Find
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Model
   */
  public function find($id)
  {
    return $this->post->find($id);
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
    $post = $this->find($id);

    return $post->delete();
  }

}
