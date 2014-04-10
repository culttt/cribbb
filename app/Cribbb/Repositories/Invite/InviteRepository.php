<?php namespace Cribbb\Repositories\Invite;

interface InviteRepository {

  /**
   * Find a valid invite by a code
   *
   * @param string $code
   * @return Illuminate\Database\Eloquent\Model
   */
  public function getValidInviteByCode($code);

}
