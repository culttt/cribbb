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
   *
   */
  public function twitter()
  {
    $creds = $this->twitter->getTemporaryCredentials();

    Session::put('creds', $creds);
    Session::save();

    $this->twitter->authorize(Session::get('creds'));
  }

  /**
   * Recieve the call back from
   * the authentication provider
   */
  public function callback()
  {
    // We will now retrieve token credentials from the server
    $tokenCredentials = $this->twitter->getTokenCredentials(Session::get('creds'), Input::get('oauth_token'), Input::get('oauth_verifier'));

    echo "<pre>";

    var_dump('Get Identifier');
    var_dump($tokenCredentials->getIdentifier());

    var_dump('Get Secret');
    var_dump($tokenCredentials->getSecret());

    var_dump('Get user details');
    var_dump($this->twitter->getUserDetails($tokenCredentials));

    var_dump('Get user uid');
    var_dump($this->twitter->getUserUid($tokenCredentials));

    var_dump('Get user email');
    var_dump($this->twitter->getUserEmail($tokenCredentials));

    var_dump('Get token credentials');
    var_dump($this->twitter->getUserScreenName($tokenCredentials));
  }

}













