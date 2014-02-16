<?php namespace Cribbb\Repositories\User;

interface UserRepository {

  /**
   * Feed
   *
   * @param int $id
   * @return object
   */
  public function feed($id);

  /**
   * Cribbbs
   *
   * @param int $id
   * @return Collection
   */
  public function cribbbs($id);

}
