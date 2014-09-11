<?php namespace Cribbb\Application;

use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use BigName\EventDispatcher\Dispatcher;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\Password;
use Cribbb\Domain\Model\Identity\EmailIsUnique;
use Cribbb\Domain\Model\Identity\HashingService;
use Cribbb\Domain\Model\Identity\UserRepository;
use Cribbb\Domain\Model\Identity\UsernameIsUnique;
use Cribbb\Application\Commands\RegisterUserCommand;
use Cribbb\Domain\Model\Identity\ValueIsNotUniqueException;

class IdentityApplicationService
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
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * Create a new instance of the IdentityApplicationService
     *
     * @param UserRepository $userRepository
     * @param HashingService $hashingService
     * @param Dispatcher $dispatcher;
     * @return void
     */
    public function __construct(
        UserRepository $userRepository,
        HashingService $hashingService,
        Dispatcher $dispatcher
    )
    {
        $this->userRepository = $userRepository;
        $this->hashingService = $hashingService;
        $this->dispatcher = $dispatcher;
    }

    /**
     * Register a new user
     *
     * @param string $email
     * @param string $username
     * @param string $password
     * @return User
     */
    public function registerUser($email, $username, $password)
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

        $this->dispatcher->dispatch($user->release());

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
