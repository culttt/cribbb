<?php

use Cribbb\Authenticators\Providers\Twitter;

class AuthController extends BaseController {

  /**
   * Twitter Authenticator
   *
   * @var Cribbb\Authenticators\Providers\Twitter
   */
  protected $twitter;

  /**
   * Create a new instance of
   * the Authentication Controller
   *
   * @param Cribbb\Authenticators\Providers\Twitter
   */
  public function __construct(Twitter $twitter)
  {
    $this->twitter = $twitter;
  }

  /**
   * Authenticate through Twitter
   */
  public function twitter()
  {
    $credentials = $this->twitter->getTemporaryCredentials();

    Session::put('temp_credentials', $credentials);
    Session::save();

    $this->twitter->authorize($credentials);
  }

  /**
   * Receive the callback from
   * the authentication provider
   */
  public function callback()
  {
    $token = $this->twitter->getTokenCredentials(
      Session::get('temp_credentials'),
      Input::get('oauth_token'),
      Input::get('oauth_verifier')
    );

    var_dump($token->getIdentifier());
    var_dump($token->getSecret());
    var_dump($this->twitter->getUserDetails($token));
    var_dump($this->twitter->getUserUid($token));
    var_dump($this->twitter->getUserEmail($token));
    var_dump($this->twitter->getUserScreenName($token));
  }

}
