<?php namespace Cribbb\Tests\Domain;

use stdClass;
use Cribbb\Stubs\EventStub;
use Cribbb\Domain\Dispatcher;
use Cribbb\Stubs\ListenerStub;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{
    /** @var Dispatcher */
    private $dispatcher;

    public function setUp()
    {
        $this->dispatcher = new Dispatcher;
    }

    /** @test */
    public function should_return_empty_array_when_no_listeners_registered()
    {
        $listeners = $this->dispatcher->registered('EventStub');

        $this->assertEquals([], $listeners);
    }

    /** @test */
    public function should_add_listener()
    {
        $this->assertEquals(0, count($this->dispatcher->registered('EventStub')));

        $this->dispatcher->add('EventStub', new ListenerStub);

        $this->assertEquals(1, count($this->dispatcher->registered('EventStub')));
    }

    /** @test */
    public function should_handler_domain_event()
    {
        $this->dispatcher->add('EventStub', new ListenerStub);

        $counter = new stdClass;
        $counter->count = 0;

        $event = new EventStub($counter);

        $this->dispatcher->dispatch([$event]);

        $this->assertEquals(1, $counter->count);
    }
}
