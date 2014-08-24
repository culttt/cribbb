<?php namespace Cribbb\Application;

use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\Password;
use Cribbb\Domain\Model\Identity\HashingService;
use Cribbb\Domain\Model\Identity\UserRepository;
use Cribbb\Application\Commands\RegisterUserCommand;

class IdentityApplicationService {

  /**
   * @var UserRepository
   */
  private $userRepository;

  /**
   * Create a new instance of the IdentityApplicationService
   *
   * @param UserRepository $userRepository
   * @param HashingService $hashingService
   * @return void
   */
  public function __construct(
    UserRepository $userRepository,
    HashingService $hashingService
  )
  {
    $this->userRepository = $userRepository;
    $this->hashingService = $hashingService;
  }

  /**
   * Register a new user
   *
   * @param RegisterUserCommand $command
   * @return User
   */
  public function registerUser(RegisterUserCommand $command)
  {
    $id       = $this->userRepository->nextIdentity();
    $email    = new Email($command->email);
    $username = new Username($command->email);
    $password = $this->hashingService->hash(new Password($command->password));
    $user     = User::register($id, $email, $username, $password);

    $this->userRepository->add($user);

    return $user;
  }

}
