<?php

use Cribbb\Repositories\User\UserRepository;

class JoinController extends BaseController {

  /**
   * The User Repository
   *
   * @var Cribbb\Repositories\User\UserRepository
   */
  protected $repository;

  /**
   * Create a new instance of the JoinController
   *
   * @param Cribbb\Repositories\User\UserRepository $repository
   */
  public function __construct(UserRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Display the form to allow a user to sign up
   *
   * @return View
   */
  public function index()
  {
    return View::make('join.index');
  }

  /**
   * Accept the POST request to register a new user
   *
   * @return Redirect
   */
  public function create()
  {
    $user = $this->repository->create(Input::all());

    if($user)
    {
      return Redirect::route('')->with('message', '');
    }

    return Redirect::route('join.index')->withInput()->withErrors($this->repository->errors());
  }

}
