<?php namespace Cribbb\Application\Identity;

use BigName\EventDispatcher\Dispatcher;
use Cribbb\Domain\Services\RegisterUserService;

class IdentityApplicationService
{
    /**
     * @var RegisterUserService
     */
    private $registerUserService;

    /**
     * @var PasswordReminderService
     */
    private $passwordReminderService;

    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * Create a new IdentityApplicationService
     *
     * @param RegisterUserService $registerUserService
     * @param PasswordReminderService $passwordReminderService
     * @param Dispatcher $dispatcher
     * @return void
     */
    public function __construct(
        RegisterUserService $registerUserService,
        PasswordReminderService $passwordReminderService,
        Dispatcher $dispatcher
    )
    {
        $this->registerUserService     = $registerUserService;
        $this->passwordReminderService = $passwordReminderService;
        $this->dispatcher              = $dispatcher;
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

    /**
     * Request a password reminder
     *
     * @param RequestReminderCommand $command
     * @return Cribbb\Domain\Model\Identity\Reminder
     */
    public function requestPasswordReminder(RequestReminderCommand $command)
    {
        $reminder = $this->passwordReminderService->request($command->email);

        $this->dispatcher->dispatch($reminder->release());

        return $reminder;
    }

    /**
     * Check a reminder is valid
     *
     * @param CheckReminderCommand $command
     * @return bool
     */
    public function checkPasswordReminderIsValid(CheckReminderCommand $command)
    {
        return $this->passwordReminderService->check($command->email, $command->code);
    }

    /**
     * Reset a user's password
     *
     * @param ResetPasswordCommand $command
     * @return Cribbb\Domain\Model\Identity\User
     */
    public function resetUserPassword(ResetPasswordCommand $command)
    {
        $user = $this->passwordReminderService->reset(
            $command->email,
            $command->password,
            $command->code
        );

        $this->dispatcher->dispatch($user->release());

        return $user;
    }
}
