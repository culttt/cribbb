<?php namespace Cribbb\Repositories\User;

use Illuminate\Support\MessageBag;
use Cribbb\Repositories\Repository;
use Cribbb\Repositories\Crudable;
use Cribbb\Repositories\Paginable;
use Illuminate\Database\Eloquent\Model;
use Cribbb\Repositories\AbstractRepository;
use Cribbb\Repositories\Post\PostRepository;

class EloquentUserRepository extends AbstractRepository implements Repository, Crudable, Paginable, UserRepository {

  /**
   * @var Model
   */
  protected $model;

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
  public function __construct(Model $model, PostRepository $post)
  {
    parent::__construct(new MessageBag);

    $this->model = $model;
    $this->post = $post;
  }

  /**
   * Create
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function create(array $data){}

  /**
   * Update
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function update(array $data){}

  /**
   * Delete
   *
   * @param int $id
   * @return boolean
   */
  public function delete($id)
  {
    $user = $this->find($id);

    if($user)
    {
      return $user->delete();
    }
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
