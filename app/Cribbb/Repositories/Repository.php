<?php namespace Cribbb\Repositories;

interface Repository {

  /**
   * Retrieve all entities
   *
   * @param array $with
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all(array $with = array());

  /**
   * Search for many results by key and value
   *
   * @param string $key
   * @param mixed $value
   * @param array $with
   * @return Illuminate\Database\Query\Builders
   */
  public function getManyBy($key, $value, array $with = array());

  /**
   * Search a single result by key and value
   *
   * @param string $key
   * @param mixed $value
   * @param array $with
   * @return Illuminate\Database\Query\Builders
   */
  public function getFirstBy($key, $value, array $with = array());

  /**
   * Return the errors
   *
   * @return Illuminate\Support\MessageBag
   */
  public function errors();

}
