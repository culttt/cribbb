<?php namespace Cribbb\Storage\Post;

use Illuminate\Database\Eloquent\Model;

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
   * @return Illuminate\Database\Eloquent\Model
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

  /**
   * Get User Feed
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Model
   */
  public function getUserFeed($id)
  {
    return $this->post->whereIn('user_id', function($query) use ($id)
    {
      $query->select('follow_id')
            ->from('user_follows')
            ->where('user_id', $id);
    })->orWhere('user_id', $id)
      ->get();
  }

}
