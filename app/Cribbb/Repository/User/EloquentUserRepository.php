<?php namespace Cribbb\Repository\User;

use Illuminate\Database\Eloquent\Model;
use Cribbb\Repository\RepositoryInterface;
use Cribbb\Repository\Post\PostRepository;

class EloquentUserRepository implements RepositoryInterface, UserRepository {

  /**
   * @var Model
   */
  protected $user;

  /**
   * @var PostRepository
   */
  protected $post;

  /**
   * Construct
   *
   * @param Illuminate\Database\Eloquent\Model $user
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
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all()
  {
    return $this->user->all();
  }

  /**
   * Find
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Model
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
    $user = $this->find($id);

    return $user->delete();
  }

  /**
   * Feed
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function feed($id)
  {
    return $this->post->whereIn('user_id', function($query) use ($id)
    {
      $query->select('follow_id')
            ->from('user_follows')
            ->where('user_id', $id);
    })->orWhere('user_id', $id)->get();
  }

  /**
   * Cribbbs
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function cribbbs($id)
  {
    $user = $this->find($id);

    if($user)
    {
      return $user->cribbbs();
    }
  }

}
