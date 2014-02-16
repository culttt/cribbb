<?php namespace Cribbb\Repositories\Post;

use Illuminate\Support\MessageBag;
use Cribbb\Repositories\Repository;
use Cribbb\Repositories\Crudable;
use Cribbb\Repositories\Paginable;
use Illuminate\Database\Eloquent\Model;
use Cribbb\Repositories\AbstractRepository;
use Cribbb\Repositories\Post\PostRepository;

class EloquentPostRepository extends AbstractRepository implements Repository, Crudable, Paginable, PostRepository {

  /**
   * @var Model
   */
  protected $model;

  /**
   * Construct
   *
   * @param Illuminate\Database\Eloquent\Model $model
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
  public function delete($id){}

}
