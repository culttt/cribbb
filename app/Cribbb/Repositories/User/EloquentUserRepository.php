<?php namespace Cribbb\Repositories\User;

use Cribbb\Repositories\Crudable;
use Illuminate\Support\MessageBag;
use Cribbb\Repositories\Paginable;
use Cribbb\Repositories\Repository;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Database\Eloquent\Model;
use Cribbb\Repositories\AbstractRepository;

class EloquentUserRepository extends AbstractRepository implements Repository, Crudable, Paginable, UserRepository {

  /**
   * @var Illuminate\Database\Eloquent\Model
   */
  protected $model;

  /**
   * Construct
   *
   * @param Illuminate\Database\Eloquent\Model $user
   */
  public function __construct(Model $model, BcryptHasher $hasher)
  {
    parent::__construct(new MessageBag);

    $this->model = $model;
    $this->hasher = $hasher;
  }

  /**
   * Create
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function create(array $data)
  {
    if($this->isValid('create', $data))
    {
      $data['password'] = $this->hasher->make($data['password']);

      return $this->model->create($data);
    }
  }

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
