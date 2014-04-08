<?php

use Cribbb\Repositories\Invite\InviteRepository;

class InviteController extends BaseController {

  /**
   * InviteRepository
   *
   * @var Cribbb\Repositories\Invite\InviteRepository
   */
  protected $repository;

  /**
   * Create a new instance of the InviteController
   *
   * @param Cribbb\Repositories\Invite\InviteRepository
   */
  public function __construct(InviteRepository $repository)
  {
    $this->repository = $repository;
  }

  /**
   * Create a new invite
   *
   * @return Response
   */
  public function store()
  {
    $invite = $this->repository->create(Input::all());
  }

}
