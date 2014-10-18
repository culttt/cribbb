<?php namespace Cribbb\Tests\Application;

use stdClass;
use Cribbb\Stubs\CommandStub;
use Cribbb\Application\NameInflector;

class NameInflectorTest extends \PHPUnit_Framework_TestCase
{
    /** @var Inflector */
    private $inflector;

    public function setUp()
    {
        $this->inflector = new NameInflector;
    }

    /** @test */
    public function should_get_handler_name_from_command()
    {
        $command = new CommandStub(new stdClass);

        $handler = $this->inflector->inflect($command);

        $this->assertEquals('Cribbb\Stubs\HandlerStub', $handler);
    }
}
