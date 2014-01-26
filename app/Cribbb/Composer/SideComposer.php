<?php namespace Cribbb\Composer;

use Cribbb\Entity\User\UserEntity;

class SideComposer {

  /**
   * Construct
   *
   * @param Cribbb\Entity\User\UserEntity $user
   */
  public function __construct(UserEntity $user)
  {
    $this->user = $user;
  }

  /**
   * Compose
   *
   * @param View
   */
  public function compose($view)
  {
    $user = Auth::user();
    $view->with('user', $user);
    $view->with('cribbbs', $this->user->cribbbs($user->id));
  }

}
