<?php namespace Cribbb\Repositories;

use StdClass;
use Illuminate\Support\MessageBag;
use Cribbb\Validation\Validable;

abstract class AbstractRepository {

  /**
   * @var Illuminate\Database\Eloquent\Model
   */
  protected $model;

  /**
   * @var Illuminate\Support\MessageBag
   */
  protected $errors;

  /**
   * Construct
   *
   * @param Illuminate\Support\MessageBag $errors
   */
  public function __construct(MessageBag $errors)
  {
    $this->errors = $errors;
  }

  /**
   * Make a new instance of the entity to query on
   *
   * @param array $with
   */
  public function make(array $with = array())
  {
    return $this->model->with($with);
  }

  /**
   * Register Validators
   *
   * @param string $name
   * @param Validible $validator
   */
  public function registerValidator($name, $validator)
  {
    $this->validators[$name] = $validator;
  }

  /**
   * Check to see if the input data is valid
   *
   * @param array $data
   * @return boolean
   */
  public function isValid($name, array $data)
  {
    if( $this->validators[$name]->with($data)->passes() )
    {
      return true;
    }

    $this->errors = $this->validators[$name]->errors();
    return false;
  }

  /**
   * Retrieve all entities
   *
   * @param array $with
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all(array $with = array())
  {
    $entity = $this->make($with);

    return $entity->get();
  }

  /**
   * Find a single entity
   *
   * @param int $id
   * @param array $with
   * @return Illuminate\Database\Eloquent\Model
   */
  public function find($id, array $with = array())
  {
    $entity = $this->make($with);

    return $entity->find($id);
  }

  /**
  * Get Results by Page
  *
  * @param int $page
  * @param int $limit
  * @param array $with
  * @return StdClass Object with $items and $totalItems for pagination
  */
  public function getByPage($page = 1, $limit = 10, $with = array())
  {
    $result             = new StdClass;
    $result->page       = $page;
    $result->limit      = $limit;
    $result->totalItems = 0;
    $result->items      = array();

    $query = $this->make($with);

    $users = $query->skip($limit * ($page - 1))
                   ->take($limit)
                   ->get();

    $result->totalItems = $this->model->count();
    $result->items      = $users->all();

    return $result;
  }

  /**
   * Search for many results by key and value
   *
   * @param string $key
   * @param mixed $value
   * @param array $with
   * @return Illuminate\Database\Query\Builders
   */
  public function getManyBy($key, $value, array $with = array())
  {
    return $this->make($with)->where($key, '=', $value)->get();
  }

  /**
   * Search a single result by key and value
   *
   * @param string $key
   * @param mixed $value
   * @param array $with
   * @return Illuminate\Database\Query\Builders
   */
  public function getFirstBy($key, $value, array $with = array())
  {
    return $this->make($with)->where($key, '=', $value)->first();
  }

  /**
   * Return the errors
   *
   * @return Illuminate\Support\MessageBag
   */
  public function errors()
  {
    return $this->errors;
  }

}
