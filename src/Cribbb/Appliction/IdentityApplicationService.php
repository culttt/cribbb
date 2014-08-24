<?php namespace Cribbb\Application;

use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\Password;
use Cribbb\Domain\Model\Identity\EmailIsUnique;
use Cribbb\Domain\Model\Identity\HashingService;
use Cribbb\Domain\Model\Identity\UserRepository;
use Cribbb\Domain\Model\Identity\UsernameIsUnique;
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
    $email    = new Email($command->email);
    $username = new Username($command->username);
    $password = new Password($command->password);

    $this->checkEmailIsUnique($email);
    $this->checkUsernameIsUnique($username);

    $id       = $this->userRepository->nextIdentity();
    $password = $this->hashingService->hash($password);

    $user     = User::register($id, $email, $username, $password);

    $this->userRepository->add($user);

    return $user;
  }

  /**
   * Check that an Email is unique
   *
   * @param Email $email
   * @return void
   */
  private function checkEmailIsUnique(Email $email)
  {
    $specification = new EmailIsUnique($this->userRepository);
    $specification->isSatisfiedBy($email);
  }

  /**
   * Check that a Username is unique
   *
   * @param Username $username
   * @return void
   */
  private function checkUsernameIsUnique(Username $username)
  {
    $specification = new UsernameIsUnique($this->userRepository);
    $specification->isSatisfiedBy($username);
  }

}
