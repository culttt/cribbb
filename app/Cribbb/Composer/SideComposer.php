<?php namespace Cribbb\Composer;

use Cribbb\Entity\User\UserEntity;

class SideComposer {

  public function __construct(UserEntity $user)
  {
    $this->user = $user;
  }

  public function compose($view)
  {
    $user = Auth::user();

    $view->with('user', $user);
    $view->with('cribbbs', $this->user->cribbbs($user->id));
  }

}
