<?php namespace Cribbb\Repository;

use Illuminate\Database\Eloquent\Model;

class StubRepository implements RepositoryInterface {

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
    $this->model = $model;
  }

  /**
   * All
   *
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all()
  {
    return $this->model->all();
  }

  /**
   * Find
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Model
   */
  public function find($id)
  {
    return $this->model->find($id);
  }

  /**
   * Create
   *
   * @param array $data
   * @return boolean
   */
  public function create(array $input){}

  /**
   * Update
   *
   * @param array $data
   * @return boolean
   */
  public function update(array $input){}

  /**
   * Delete
   *
   * @param int $id
   * @return boolean
   */
  public function delete($id){}

}
