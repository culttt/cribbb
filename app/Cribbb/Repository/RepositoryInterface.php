<?php namespace Cribbb\Repository;

interface RepositoryInterface {

  /**
   * All
   *
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all();

  /**
   * Find
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Model
   */
  public function find($id);

  /**
   * Create
   *
   * @param array $data
   * @return boolean
   */
  public function create(array $input);

  /**
   * Update
   *
   * @param array $data
   * @return boolean
   */
  public function update(array $input);

  /**
   * Delete
   *
   * @param int $id
   * @return boolean
   */
  public function delete($id);

}
