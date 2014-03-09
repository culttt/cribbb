<?php

use Cribbb\Authenticators\Providers\Twitter;
use Cribbb\Registrators\SocialProvider\SocialProviderRegistrator;

class OauthController extends BaseController {

  /**
   * Twitter Authenticator
   *
   * @var Cribbb\Authenticators\Providers\Twitter
   */
  protected $twitter;

  /**
   * Registrator service
   *
   * @var Cribbb\Registrators\SocialProvider\SocialProviderRegistrator
   */
  protected $registrator;

  /**
   * Create a new instance of the Authentication Controller
   *
   * @param Cribbb\Authenticators\Providers\Twitter
   */
  public function __construct(Twitter $twitter, SocialProviderRegistrator $registrator)
  {
    $this->twitter = $twitter;
    $this->registrator = $registrator;
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
   * Receive the callback from the authentication provider
   */
  public function callback()
  {
    $token = $this->twitter->getTokenCredentials(
      Session::get('temp_credentials'),
      Input::get('oauth_token'),
      Input::get('oauth_verifier')
    );

    $user = $this->twitter->getUserDetails($token);

    Session::put('username', $user->nickname);
    Session::put('oauth_token', $token->getIdentifier());
    Session::put('oauth_token_secret', $token->getSecret());
    Session::save();

    Redirect::to('oauth/register');
  }

  /**
   * Display the form to allow the
   * user to complete their registration
   */
  public function register()
  {
    return View::make('oauth.register');
  }

  /**
   * Create the new user
   */
  public function store()
  {
    $user = $this->registrator->create(Input::all());

    if($user)
    {
      // Authenticate user
      // Redirect to home screen
    }

    return // Redirect back with errors
  }

}
