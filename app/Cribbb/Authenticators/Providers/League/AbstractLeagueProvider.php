<?php namespace Cribbb\Authenticators\Providers\League;

abstract class AbstractLeagueProvider {

  /**
   * Gets temporary credentials by performing
   * a request to the server
   *
   * @return League\OAuth1\Client\Credentials\TemporaryCredentials
   */
  public function getTemporaryCredentials()
  {
    return $this->client->getTemporaryCredentials();
  }

  /**
   * Redirect the client to the authorization URL
   *
   * @param TemporaryCredentials $temporaryIdentifier
   * @return void
   */
  public function authorize($identifier)
  {
    $this->client->authorize($identifier);
  }

  /**
   * Retrieves token credentials by passing in the temporary credentials,
   * the temporary credentials identifier as passed back by the server
   * and finally the verifier code
   *
   * @param TemporaryCredentials $credentials
   * @param string $identifier
   * @param string $verifier
   * @return TokenCredentials
   */
  public function getTokenCredentials($credentials, $identifier, $verifier)
  {
    return $this->client->getTokenCredentials($credentials, $identifier, $verifier);
  }

  /**
   * Get user details by providing valid token credentials
   *
   * @param TokenCredentials $token
   * @param bool $force
   * @return League\OAuth1\Client\Server\User
   */
  public function getUserDetails($token, $force = false)
  {
    return $this->client->getUserDetails($token, $force);
  }

  /**
   * Get the user's unique identifier
   *
   * @param TokenCredentials $token
   * @param bool $force
   * @return string
   */
  public function getUserUid($token, $force = false)
  {
    return $this->client->getUserUid($token, $force);
  }

  /**
   * Get the user's email, if available
   *
   * @param TokenCredentials $token
   * @param bool $force
   * @return string
   */
  public function getUserEmail($token, $force = false)
  {
    return $this->client->getUserEmail($token, $force);
  }

  /**
   * Get the user's screen name (username), if available
   *
   * @param TokenCredentials $token
   * @param bool $force
   * @return string
   */
  public function getUserScreenName($token, $force = false)
  {
    return $this->client->getUserScreenName($token, $force);
  }

}
