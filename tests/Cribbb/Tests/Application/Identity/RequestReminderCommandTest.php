<?php namespace Cribbb\Application\Identity;

use Cribbb\Application\Identity\RequestReminderCommand;

class RequestReminderCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_create_request_reminder_command()
    {
        $command = new RequestReminderCommand('name@domain.com');

        $this->assertEquals('name@domain.com', $command->email);
    }
}
