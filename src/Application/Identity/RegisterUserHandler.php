<?php namespace Cribbb\Application\Identity;

use Cribbb\Application\Command;
use Cribbb\Application\Handler;
use Cribbb\Domain\Services\Identity\RegisterUserService;

class RegisterUserHandler implements Handler
{
    /**
     * @var RegisterUserService
     */
    private $service;

    /**
     * Create a new RegisterUserHandler
     *
     * @param RegisterUserService $service
     * @return void
     */
    public function __construct(RegisterUserService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle a Command object
     *
     * @param Command $command
     * @return void
     */
    public function handle(Command $command)
    {
        $user = $this->service->register(
            $command->email,
            $command->username,
            $command->password
        );
    }
}
