<?php namespace Cribbb\Tests\Application\Identity;

use Mockery as m;
use Cribbb\Application\Identity\PasswordResetRequestCommand;
use Cribbb\Application\Identity\PasswordResetRequestHandler;

class PasswordResetRequestHandlerTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_request_password_reminder()
    {
        $service = m::mock('Cribbb\Domain\Services\Identity\ReminderService');
        $service->shouldReceive('request')->once();

        $handler = new PasswordResetRequestHandler($service);
        $command = new PasswordResetRequestCommand('name@domain.com');

        $handler->handle($command);
    }
}
