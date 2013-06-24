<?php namespace Cribbb\Storage\User;

use User;

class EloquentUserRepository implements UserRepository {

  public function all()
  {
    return User::all();
  }

  public function find($id)
  {
    return User::find($id);
  }

  public function create($input)
  {
    return User::create($input);
  }

  public function update($id)
  {
    $user = $this->find($id);

    $user->save(\Input::all());

    return $user;
  }

  public function delete($id)
  {
    $user = $this->find($id);

    return $user->delete();
  }

}