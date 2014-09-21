<?php namespace Cribbb\Application\Identity;

use Cribbb\Application\Identity\CheckReminderCommand;

class CheckReminderCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_create_check_reminder_command()
    {
        $command = new CheckReminderCommand('name@domain.com', 'abc124');

        $this->assertEquals('name@domain.com', $command->email);
        $this->assertEquals('abc124',        $command->code);
    }
}
