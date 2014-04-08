<?php namespace Cribbb\Repositories\Invite;

use Cribbb\Repositories\Crudable;
use Illuminate\Support\MessageBag;
use Cribbb\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Cribbb\Repositories\AbstractRepository;

class EloquentInviteRepository extends AbstractRepository implements Repository, Crudable, InviteRepository {

  /**
   * @var Illuminate\Database\Eloquent\Model
   */
  protected $model;

  /**
   * Construct
   *
   * @param Illuminate\Database\Eloquent\Model $user
   */
  public function __construct(Model $model)
  {
    parent::__construct(new MessageBag);

    $this->model = $model;
  }

  /**
   * Create
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function create(array $data)
  {
    $data['code'] = bin2hex(openssl_random_pseudo_bytes(16));

    return $this->model->create($data);
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
  public function delete($id){}

}
