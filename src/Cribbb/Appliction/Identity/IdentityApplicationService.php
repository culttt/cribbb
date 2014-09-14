<?php namespace Cribbb\Application\Identity;

use BigName\EventDispatcher\Dispatcher;

class IdentityApplicationService
{
    /**
     * @var RegisterUserService
     */
    private $registerUserService;

    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * Create a new IdentityApplicationService
     *
     * @param RegisterUserService $registerUserService
     * @param Dispatcher $dispatcher
     * @return void
     */
    public function __construct(RegisterUserService $registerUserService, Dispatcher $dispatcher)
    {
        $this->registerUserService = $registerUserService;
        $this->dispatcher          = $dispatcher;
    }

    /**
     * Register a new User
     *
     * @param RegisterUserCommand $command
     * @return Cribbb\Domain\Model\Identity\User
     */
    public function registerUser(RegisterUserCommand $command)
    {
        $user = $this->registerUserService->register(
            $command->email,
            $command->username,
            $command->password
        );

        $this->dispatcher->dispatch($user->release());

        return $user;
    }
}
