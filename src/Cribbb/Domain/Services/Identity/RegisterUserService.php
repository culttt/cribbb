<?php namespace Cribbb\Domain\Services\Identity;

use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\Password;
use Cribbb\Domain\Model\Identity\EmailIsUnique;
use Cribbb\Domain\Model\Identity\UserRepository;
use Cribbb\Domain\Model\Identity\UsernameIsUnique;
use Cribbb\Domain\Services\Identity\HashingService;
use Cribbb\Domain\Model\Identity\ValueIsNotUniqueException;

class RegisterUserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var HashingService
     */
    private $hashingService;

    /**
     * Create a new RegisterUserService
     *
     * @param UserRepository $userRepository
     * @param HashingService $hashingService
     * @return void
     */
    public function __construct(UserRepository $userRepository, HashingService $hashingService)
    {
        $this->userRepository = $userRepository;
        $this->hashingService = $hashingService;
    }

    /**
     * Register a new User
     *
     * @param string $email
     * @param string $username
     * @param string $password
     * @return void
     */
    public function register($email, $username, $password)
    {
        $email    = new Email($email);
        $username = new Username($username);
        $password = new Password($password);

        $this->checkEmailIsUnique($email);
        $this->checkUsernameIsUnique($username);

        $id       = $this->userRepository->nextIdentity();
        $password = $this->hashingService->hash($password);

        $user = User::register($id, $email, $username, $password);

        $this->userRepository->add($user);

        return $user;
    }

    /**
     * Check that an Email is unique
     *
     * @param Email $email
     * @throws ValueIsNotUniqueException
     * @return void
     */
    private function checkEmailIsUnique(Email $email)
    {
        $specification = new EmailIsUnique($this->userRepository);

        if(! $specification->isSatisfiedBy($email)) {
            throw new ValueIsNotUniqueException("$email is already registered");
        }
    }

    /**
     * Check that a Username is unique
     *
     * @param Username $username
     * @throws ValueIsNotUniqueException
     * @return void
     */
    private function checkUsernameIsUnique(Username $username)
    {
        $specification = new UsernameIsUnique($this->userRepository);

        if(! $specification->isSatisfiedBy($username)) {
            throw new ValueIsNotUniqueException("$username has already been taken");
        }
    }
}
