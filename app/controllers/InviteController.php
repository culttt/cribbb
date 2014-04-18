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
    $invite = $this->requester->create(Input::all());

    if($invite)
    {
      // yay
    }

    // oh no
    $this->requester->errors();
  }

}
