<?php namespace Cribbb\Inviters\Policies;

use User;

class UserHasInvitations implements Policy {

  /**
   * Run the policy check on the current user
   *
   * @param User $user
   * @return bool
   */
  public function run(User $user)
  {
    if($user->invitations > 0)
    {
      return true;
    }

    throw new InvitePolicyException("{$user->name} does not have any invitations");
  }

}
