<?php

use Cribbb\Storage\User\UserRepository as User;

class UserController extends BaseController {

  /**
   * User Repository
   */
  protected $user;

  /**
   * Inject the User Repository
   */
  public function __construct(User $user)
  {
    $this->user = $user;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    return $this->user->all();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return View::make('users.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $s = $this->user->create(Input::all());

    if($s->isSaved())
    {
      return Redirect::route('user.index')
        ->with('flash', 'The new user has been created');
    }

    return Redirect::route('user.create')
      ->withInput()
      ->withErrors($s->errors());
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    return $this->user->find($id);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    $user = $this->user->find($id);

    return View::make('users.edit')->with('user', $user);;
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    $s = $this->user->update($id);

    if($s->isSaved())
    {
      return Redirect::route('user.show', $id)
        ->with('flash', 'The user was updated');
    }

    return Redirect::route('user.edit', $id)
      ->withInput()
      ->withErrors($s->errors());
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    return $this->user->delete($id);
  }

}