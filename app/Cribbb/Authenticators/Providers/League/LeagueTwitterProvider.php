<?php namespace Cribbb\Authenticators\Providers\League;

use Cribbb\Authenticators\Providers\Twitter;
use League\OAuth1\Client\Server\Twitter as Client;

class LeagueTwitterProvider extends AbstractLeagueProvider implements Twitter {

  /**
   * The injected client
   *
   * @var League\OAuth1\Client\Server\Twitter
   */
  protected $client;

  /**
   * Create a new instance of LeagueTwitterProvider
   *
   * @param League\OAuth1\Client\Server\Twitter
   */
  public function __construct(Client $client)
  {
    $this->client = $client;
  }

}
