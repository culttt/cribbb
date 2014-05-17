<?php

use Cribbb\Authenticators\Manager;

class SessionController extends BaseController {

  /**
   * The Provider Manager instance
   *
   * @param Cribbb\Authenticators\Manager
   */
  protected $manager;

  /**
   * Create a new instance of the SessionController
   *
   * @param Cribbb\Authenticators\Manager
   * @return void
   */
  public function __construct(Manager $manager)
  {
    $this->manager = $manager;
  }

  /**
   * Display the form to allow a user to log in
   *
   * @return View
   */
  public function create()
  {
    if (Auth::user())
    {
      return Redirect::route('home.index');
    }

    $this->layout->title = "Sign in";
    $this->layout->nest('content', 'session.create');
  }

  /**
   * Accept the POST request and create a new session
   *
   * @return Redirect
   */
  public function store()
  {
    if (Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')]))
    {
      return Redirect::route('home.index');
    }

    return Redirect::route('session.create')->withInput()
                                            ->with('error', 'Your email or password was incorrect, please try again!');
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
   * Destroy an existing session
   *
   * @return Redirect
   */
  public function destroy()
  {
    Auth::logout();

    return Redirect::route('session.create')->with('message', 'You have successfully logged out!');
  }

}
