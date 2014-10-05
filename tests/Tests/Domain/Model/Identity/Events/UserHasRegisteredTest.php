<?php namespace Cribbb\Tests\Domain\Model\Identity\Events;

use Cribbb\Domain\Model\Identity\Events\UserHasRegistered;

class UserHasRegisteredTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_get_event_name()
    {
        $event = new UserHasRegistered;

        $this->assertEquals('UserHasRegistered', $event->name());
    }
}
