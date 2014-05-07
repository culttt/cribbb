<?php

use Cribbb\Authenticators\Manager;

class AuthenticateController extends BaseController {

  /**
   * The Provider Manager instance
   *
   * @param Cribbb\Authenticators\Manager
   */
  protected $manager;

  /**
   * Create a new instance of the AuthenticateController
   *
   * @param Cribbb\Authenticators\Manager
   * @return void
   */
  public function __construct(Manager $manager)
  {
    //$this->beforeFilter('invite');
    $this->manager = $manager;
  }

  /**
   * Authorise an authentication request
   *
   * @return Redirect
   */
  public function authorise($provider)
  {
    try
    {
      $provider = $this->manager->get($provider);

      $credentials = $provider->getTemporaryCredentials();

      Session::put('credentials', $credentials);
      Session::save();

      return $provider->authorize($credentials);
    }

    catch(Exception $e)
    {
      return App::abort(404);
    }
  }

  /**
   * Receive the callback from the authentication provider
   *
   * @return Redirect
   */
  public function callback($provider)
  {
    try
    {
      $provider = $this->manager->get($provider);

      $token = $provider->getTokenCredentials(
        Session::get('credentials'),
        Input::get('oauth_token'),
        Input::get('oauth_verifier')
      );

      $user = $provider->getUserDetails($token);

      Session::put('username', $user->nickname);
      Session::put('oauth_token', $token->getIdentifier());
      Session::put('oauth_token_secret', $token->getSecret());
      Session::save();

      echo "<pre>";
      dd($user);
    }

    catch(Exception $e)
    {
      return App::abort(404);
    }
  }

}
