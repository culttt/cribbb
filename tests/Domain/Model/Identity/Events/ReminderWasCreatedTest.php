<?php namespace Cribbb\Tests\Domain\Model\Identity\Events;

use Cribbb\Domain\Model\Identity\Events\ReminderWasCreated;

class ReminderWasCreatedTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_get_event_name()
    {
        $event = new ReminderWasCreated;

        $this->assertEquals('ReminderWasCreated', $event->name());
    }
}
