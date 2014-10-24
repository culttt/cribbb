<?php namespace Cribbb\Application\Identity;

use Cribbb\Application\Command;
use Cribbb\Application\Handler;
use Cribbb\Domain\Services\Identity\ReminderService;

class PasswordResetRequestHandler implements Handler
{
    /**
     * @var ReminderService
     */
    private $service;

    /**
     * Create a new PasswordResetRequestHandler
     *
     * @param ReminderService $service
     * @return void
     */
    public function __construct(ReminderService $service)
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
        $reminder = $this->service->request($command->email);
    }
}
