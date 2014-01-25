<?php namespace Cribbb\Repository\User;

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
   * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function cribbbs($id);

}
