<?php namespace Cribbb\Tests\Domain\Model\Identity\Events;

use Cribbb\Domain\Model\Identity\Events\PasswordReminderCreated;

class PasswordReminderCreatedTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_get_event_name()
    {
        $event = new PasswordReminderCreated;

        $this->assertEquals('PasswordReminderCreated', $event->name());
    }
}
