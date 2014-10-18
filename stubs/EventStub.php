<?php namespace Cribbb\Stubs;

use stdClass;
use Cribbb\Gettable;
use Cribbb\Domain\Event;

class EventStub implements Event
{
    use Gettable;

    /**
     * @var stdClass
     */
    private $counter;

    /**
     * Create a new Event Stub
     *
     * @param stdClass $counter
     * @return void
     */
    public function __construct(stdClass $counter)
    {
        $this->counter = $counter;
    }

    /**
     * Return the name of the Domain Event
     *
     * @return string
     */
    public function name()
    {
        return 'EventStub';
    }
}
