<?php namespace Cribbb\Repositories\Cribbb;

use Cribbb\Repositories\Crudable;
use Illuminate\Support\MessageBag;
use Cribbb\Repositories\Paginable;
use Cribbb\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Cribbb\Repositories\AbstractRepository;

class EloquentCribbbRepository extends AbstractRepository implements Repository, Crudable, Paginable, CribbbRepository {

  /**
   * The model instance
   *
   * @var Illuminate\Database\Eloquent\Model
   */
  protected $model;

  /**
   * Create a new instance of the EloquentCribbbRepository
   *
   * @param Illuminate\Database\Eloquent\Model $model
   */
  public function __construct(Model $model)
  {
    parent::__construct(new MessageBag);

    $this->model = $model;
  }

  /**
   * Create a new Cribbb
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function create(array $data){}

  /**
   * Update an existing Cribbb
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function update(array $data){}

  /**
   * Delete a Cribbb
   *
   * @param int $id
   * @return boolean
   */
  public function delete($id){}

}
