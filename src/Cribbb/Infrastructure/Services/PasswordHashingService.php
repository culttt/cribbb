<?php namespace Cribbb\Infrastructure\Services;

use Cribbb\Domain\Model\Users\Password;
use Illuminate\Hashing\HasherInterface;
use Cribbb\Domain\Services\PasswordService;
use Cribbb\Domain\Model\Users\HashedPassword;

class PasswordHashingService implements PasswordService {

  /**
   * @var Illuminate\Hashing\HasherInterface
   */
  private $hasher;

  /**
   * Create a new PasswordHashingService
   *
   * @param HasherInterface $hasher
   * @return void
   */
  public function __construct(HasherInterface $hasher)
  {
    $this->hasher = $hasher;
  }

  /**
   * Create a new HashedPassword
   *
   * @param Password $password
   * @return HashedPassword
   */
  public function make(Password $password)
  {
    return new HashedPassword($this->hasher->make((string) $password));
  }

  /**
   * Check if the password is valid
   *
   * @param Password $password
   * @param HashedPassword $hashed
   * @return bool
   */
  public function check(Password $password, HashedPassword $hashed)
  {
    return $this->hasher->check((string) $password, (string) $hashed);
  }

}
