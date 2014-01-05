<?php namespace Cribbb\Repository\User;

use Cribbb\Repository\RepositoryInterface;

abstract class AbstractUserDecorator implements RepositoryInterface, UserRepository {

  /**
   * @var UserRepository
   */
  protected $user;

  /**
   * Construct
   *
   * @param UserRepository $user
   */
  public function __construct(UserRepository $user)
  {
    $this->user = $user;
  }

  /**
   * All
   *
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all()
  {
    return $this->user->all();
  }

  /**
   * Find
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Model
   */
  public function find($id)
  {
    return $this->user->find($id);
  }

  /**
   * Create
   *
   * @param array $data
   * @return boolean
   */
  public function create(array $data)
  {
    return $this->user->create($data);
  }

  /**
   * Update
   *
   * @param array $data
   * @return boolean
   */
  public function update(array $data)
  {
    return $this->user->update($data);
  }

  /**
   * Delete
   *
   * @param int $id
   * @return boolean
   */
  public function delete($id)
  {
    return $this->user->delete($id);
  }

  /**
   * Feed
   *
   * @param int $id
   * @return Cribbb\Repository\Post\PostRepository
   */
  public function feed($id)
  {
    return $this->user->feed($id);
  }

}
