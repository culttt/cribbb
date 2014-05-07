<?php namespace Cribbb\Authenticators;

use Exception;

class Manager {

  /**
   * Authentication providers
   *
   * @var array
   */
  protected $providers = [];

  /**
   * Check to see if a provider has been set
   *
   * @param string $name
   * @return bool
   */
  public function has($name)
  {
    if(isset($this->providers[strtolower($name)])) return true;

    return false;
  }

  /**
   * Set a new authentication provider
   *
   * @return void
   */
  public function set($name, $provider)
  {
    $this->providers[strtolower($name)] = $provider;
  }

  /**
   * Get an existing authentication provider
   *
   * @return League\OAuth1\Client\Server
   */
  public function get($name)
  {
    if($this->has($name))
    {
      return $this->providers[strtolower($name)];
    }

    throw new Exception("$name is not a valid property");
  }

}
