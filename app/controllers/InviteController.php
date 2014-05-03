<?php

use Cribbb\Inviters\Requester;

class InviteController extends BaseController {

  /**
   * The Invite Request service
   *
   * @var Cribbb\Inviters\Requester
   */
  protected $requester;

  /**
   * Create a new instance of the InviteController
   *
   * @param Cribbb\Inviters\Requester
   */
  public function __construct(Requester $requester)
  {
    $this->requester = $requester;
  }

  /**
   * Create a new invite
   *
   * @return Response
   */
  public function store()
  {
    $invite = $this->requester->create(Input::all(), Session::get('referral', null));

    if($invite)
    {
      return Redirect::route('home.index')->with('message', 'Thank you for requesting an invite to Cribbb!');
    }

    return Redirect::route('home.index')->withInput()->withErrors($this->requester->errors());
  }

}
