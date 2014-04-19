<?php namespace Cribbb\Inviters\Policies;

use User;

interface Policy {

  /**
   * Run the policy check on the current user
   *
   * @param User $user
   * @return bool
   */
  public function run(User $user);

}
