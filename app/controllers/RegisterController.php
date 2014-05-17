<?php

use Cribbb\Registrators\CredentialsRegistrator;

class RegisterController extends BaseController {

  /**
   * Create a new instance of the RegisterController
   *
   * @return void
   */
  public function __construct(CredentialsRegistrator $registrator)
  {
    $this->beforeFilter('invite');
    $this->registrator = $registrator;
  }

  /**
   * Display the form for creating a new user
   *
   * @return View
   */
  public function index()
  {
    $this->layout->title = 'Join Cribbb';
    $this->layout->nest('content', 'register.index');
  }

  /**
   * Create a new user
   *
   * @return Redirect
   */
  public function store()
  {
    $user = $this->registrator->create(array_merge(
      Input::all(), [
        'referrer_id' => Session::get('referrer_id'),
        'invitation_code' => Session::get('invitation_code')
      ]
    ));

    if($user)
    {
      Auth::login($user);

      return Redirect::route('home.index');
    }

    return Redirect::route('register.index')->withInput()
                                            ->withErrors($this->registrator->errors());
  }

}
