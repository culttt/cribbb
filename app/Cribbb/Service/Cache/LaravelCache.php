<?php namespace Cribbb\Service\Cache;

use Illuminate\Cache\CacheManager;

class LaravelCache implements CacheInterface {

 /**
  * @var Illuminate\Cache\CacheManager
  */
  protected $cache;

  /**
   * @var string
   */
  protected $tag;

  /**
   * @var integer
   */
  protected $minutes;

  /**
   * Construct
   *
   * @param Illuminate\Cache\CacheManager $cache
   * @param string $tag
   * @param integer $minutes
   */
  public function __construct(CacheManager $cache, $tag, $minutes = 60)
  {
    $this->cache = $cache;
    $this->tag = $tag;
    $this->minutes = $minutes;
  }

  /**
   * Get
   *
   * @param string $key
   * @return mixed
   */
  public function get($key)
  {
    return $this->cache->tags($this->tag)->get($key);
  }

  /**
   * Put
   *
   * @param string $key
   * @param mixed $value
   * @param integer $minutes
   * @return mixed
   */
  public function put($key, $value, $minutes = null)
  {
    if( is_null($minutes) )
    {
      $minutes = $this->minutes;
    }

    return $this->cache->tags($this->tag)->put($key, $value, $minutes);
  }

  /**
   * Has
   *
   * @param string $key
   * @return bool
   */
  public function has($key)
  {
    return $this->cache->tags($this->tag)->has($key);
  }

}
