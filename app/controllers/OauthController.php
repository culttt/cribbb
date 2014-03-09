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
   *
   * @return Redirect
   */
  public function authorize()
  {
    $credentials = $this->twitter->getTemporaryCredentials();

    Session::put('temp_credentials', $credentials);
    Session::save();

    $this->twitter->authorize($credentials);
  }

  /**
   * Receive the callback from the authentication provider
   *
   * @return Redirect
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

    return Redirect::route('oauth.register');
  }

  /**
   * Display the form to allow the
   * user to complete their registration
   *
   * @return View
   */
  public function register()
  {
    return View::make('oauth.register');
  }

  /**
   * Create the new user
   *
   * @return Redirect
   */
  public function store()
  {
    $user = $this->registrator->create(array(
      'username' => Session::get('username'),
      'email' => Input::get('email'),
      'oauth_token' => Session::get('oauth_token'),
      'oauth_token_secret' => Session::get('oauth_token_secret')
    ));

    if($user)
    {
      die('Great success!');
    }

    return Redirect::route('oauth.register')->withInput()->withErrors($this->registrator->errors());
  }

}
