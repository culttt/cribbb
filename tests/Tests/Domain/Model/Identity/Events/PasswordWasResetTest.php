<?php namespace Cribbb\Tests\Domain\Model\Identity\Events;

use Cribbb\Domain\Model\Identity\Events\PasswordWasReset;

class PasswordWasResetTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_get_event_name()
    {
        $event = new PasswordWasReset;

        $this->assertEquals('PasswordWasReset', $event->name());
    }
}
