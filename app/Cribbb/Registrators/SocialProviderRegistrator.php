<?php namespace Cribbb\Registrators;

use User;
use Cribbb\Repositories\User\UserRepository;

class SocialProviderRegistrator extends AbstractRegistrator implements Registrator {

  /**
   * The UserRepository
   *
   * @param Cribbb\Repositories\User\UserRepository
   */
  protected $userRepository;

  /**
   * An array of Validable classes
   *
   * @param array
   */
  protected $validators;

  /**
   * Create a new instance of the CredentialsRegistrator
   *
   * @return void
   */
  public function __construct(UserRepository $userRepository, array $validators)
  {
    parent::__construct();

    $this->userRepository = $userRepository;
    $this->validators = $validators;
  }

  /**
   * Create a new user entity
   *
   * @param array $data
   * @return Illuminate\Database\Eloquent\Model
   */
  public function create(array $data)
  {
    if($this->runValidationChecks($data))
    {
      return $this->userRepository->create($data);
    }
  }

  /**
   * Find a user by their Uid
   *
   * @param string $uid
   * @return Illuminate\Database\Eloquent\Model
   */
  public function findByUid($uid)
  {
    return $this->userRepository->getBy('uid', $uid)->first();
  }

  /**
   * Update the user's tokens
   *
   * @param User $user
   * @param string $token
   * @param string $secret
   */
  public function updateUsersTokens(User $user, $token, $secret)
  {
    $user->oauth_token = $token;
    $user->oauth_token_secret = $secret;
    return $user->save();
  }

}
