<?php namespace Cribbb\Tests\Domain\Model\Identity\Events;

use Cribbb\Domain\Model\Identity\Events\UsernameWasUpdated;

class UsernameWasUpdatedTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_get_event_name()
    {
        $event = new UsernameWasUpdated;

        $this->assertEquals('UsernameWasUpdated', $event->name());
    }
}
