<?php namespace Cribbb\Repository\User;

use Cribbb\Service\Cache\CacheInterface;

class CacheDecorator extends AbstractUserDecorator {

  /**
   * @var CacheInterface
   */
  protected $cache;

  /**
   * Construct
   *
   * @param UserRepository $user
   * @param CacheInterface $cache
   */
  public function __construct(UserRepository $user, CacheInterface $cache)
  {
    parent::__construct($user);
    $this->cache = $cache;
  }

  /**
   * All
   *
   * @return Illuminate\Database\Eloquent\Collection
   */
  public function all()
  {
    $key = md5('all');

    if($this->cache->has($key))
    {
      return $this->cache->get($key);
    }

    $users = $this->user->all();

    $this->cache->put($key, $users);

    return $users;
  }

  /**
   * Find
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Model
   */
  public function find($id)
  {
    $key = md5('id.'.$id);

    if($this->cache->has($key))
    {
      return $this->cache->get($key);
    }

    $user = $this->user->find($id);

    $this->cache->put($key, $user);

    return $user;
  }

  /**
   * Feed
   *
   * @param int $id
   * @return Cribbb\Repository\Post\PostRepository
   */
  public function feed($id)
  {
    $key = md5('feed.'.$id);

    if($this->cache->has($key))
    {
      return $this->cache->get($key);
    }

    $feed = $this->user->feed($id);

    $this->cache->put($key, $feed);

    return $feed;
  }

  /**
   * Cribbbs
   *
   * @param int $id
   * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function cribbbs($id)
  {
    $key = md5('cribbbs.'.$id);

    if($this->cache->has($key))
    {
      return $this->cache->get($key);
    }

    $cribbbs = $this->user->cribbbs($id);

    $this->cache->put($key, $cribbbs);

    return $cribbbs;
  }

}
