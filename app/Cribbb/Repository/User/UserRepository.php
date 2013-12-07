<?php namespace Cribbb\Repository\User;

interface UserRepository {

  /**
   * All
   *
   * @return object
   */
  public function all();

  /**
   * Find
   *
   * @param int $id
   * @return object
   */
  public function find($id);

  /**
   * Create
   *
   * @param array $data
   * @return boolean
   */
  public function create($data);

  /**
   * Update
   *
   * @param array $data
   * @return boolean
   */
  public function update($data);

  /**
   * Delete
   *
   * @param int $id
   * @return boolean
   */
  public function delete($id);

  /**
   * Feed
   *
   * @param int $id
   * @return object
   */
  public function feed();

}
