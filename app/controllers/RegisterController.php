<?php

use Cribbb\Repositories\Invite\InviteRepository;

class RegisterController extends BaseController {

  public function __construct(InviteRepository $invite)
  {
    $this->invite = $invite;
  }

  public function index()
  {
    $invite = $this->invite->getValidInviteByCode(Input::get('code'));

    if($invite)
    {
      return View::make('register.signup');
    }

    return View::make('register.invite');
  }

}
