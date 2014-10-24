<?php namespace Cribbb\Tests\Application\Identity;

use Mockery as m;
use Cribbb\Application\Identity\RegisterUserCommand;
use Cribbb\Application\Identity\RegisterUserHandler;

class RegisterUserHandlerTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_register_user()
    {
        $service = m::mock('Cribbb\Domain\Services\Identity\RegisterUserService');
        $service->shouldReceive('register')->once();

        $handler = new RegisterUserHandler($service);
        $command = new RegisterUserCommand('name@domain.com', 'qwerty', 'password');

        $handler->handle($command);
    }
}
