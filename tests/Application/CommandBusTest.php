<?php namespace Cribbb\Tests\Application;

use stdClass;
use Cribbb\Stubs\HandlerStub;
use Cribbb\Stubs\CommandStub;
use Cribbb\Application\CommandBus;
use Illuminate\Container\Container;
use Cribbb\Application\NameInflector;
use Cribbb\Application\LaravelContainer;

class CommandBusTest extends \PHPUnit_Framework_TestCase
{
    /** @var CommandBus */
    private $bus;

    public function setUp()
    {
        $container = new Container;
        $container->bind('Cribbb\Stubs\HandlerStub', function () {
            return new HandlerStub;
        });

        $this->bus = new CommandBus(new LaravelContainer($container), new NameInflector);
    }

    /** @test */
    public function should_handle_command()
    {
        $counter = new stdClass;
        $counter->count = 0;

        $command = new CommandStub($counter);
        $this->bus->execute($command);

        $this->assertEquals(1, $counter->count);
    }
}
