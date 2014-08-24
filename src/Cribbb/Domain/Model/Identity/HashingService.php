<?php namespace Cribbb\Domain\Model\Identity;

interface HashingService {

  /**
   * Create a new HashedPassword
   *
   * @param Password $password
   * @return HashedPassword
   */
  public function hash(Password $password);

}
