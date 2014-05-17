<?php

use Cribbb\Authenticators\Manager;
use Cribbb\Registrators\SocialProviderRegistrator;

class AuthenticateController extends BaseController {

  /**
   * The Provider Manager instance
   *
   * @param Cribbb\Authenticators\Manager
   */
  protected $manager;

  /**
   * The Registrator instance
   *
   * @param Cribbb\Registrators\SocialProviderRegistrator
   */
  protected $registrator;

  /**
   * Create a new instance of the AuthenticateController
   *
   * @param Cribbb\Authenticators\Manager $manager
   * @param Cribbb\Registrators\SocialProviderRegistrator $registrator
   * @return void
   */
  public function __construct(Manager $manager, SocialProviderRegistrator $registrator)
  {
    $this->beforeFilter('invite', ['except' => 'callback']);
    $this->manager = $manager;
    $this->registrator = $registrator;
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

      $auth = $this->registrator->findByUid($user->uid);

      if($auth)
      {
        $this->registrator->updateUsersTokens($auth, $token->getIdentifier(), $token->getSecret());

        Auth::loginUsingId($auth->id);

        return Redirect::route('home.index');
      }

      Session::put('username', $user->nickname);
      Session::put('uid', $user->uid);
      Session::put('oauth_token', $token->getIdentifier());
      Session::put('oauth_token_secret', $token->getSecret());
      Session::save();

      return Redirect::route('authenticate.register');
    }

    catch(Exception $e)
    {
      return App::abort(404);
    }
  }

  /**
   * Return the form so the user can complete their registration
   *
   * @return View
   */
  public function register()
  {
    $this->layout->title = 'Join Cribbb';
    $this->layout->nest('content', 'authenticate.register', ['username' => Session::get('username')]);
  }

  /**
   * Store the user's details and authenticate on success
   *
   * @return Redirect
   */
  public function store()
  {
    $data = [
      'username'            => Input::get('username'),
      'email'               => Input::get('email'),
      'uid'                 => Session::get('uid'),
      'oauth_token'         => Session::get('oauth_token'),
      'oauth_token_secret'  => Session::get('oauth_token_secret'),
      'referrer_id'         => Session::get('referrer_id')
    ];

    $user = $this->registrator->create($data);

    if($user)
    {
      Auth::login($user);

      return Redirect::route('home.index');
    }

    return Redirect::route('authenticate.register')->withInput()
                                                   ->withErrors($this->registrator->errors());
  }

}
