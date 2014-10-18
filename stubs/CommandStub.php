<?php namespace Cribbb\Stubs;

use stdClass;
use Cribbb\Application\Command;

class CommandStub implements Command
{
    /**
     * @var int
     */
    private $counter;

    /**
     * Create a new CommandStub
     *
     * @param stdClass $counter
     * @return void
     */
    public function __construct(stdClass $counter)
    {
        $this->counter = $counter;
    }

    /**
     * Get the counter
     *
     * @return stdClass
     */
    public function counter()
    {
        return $this->counter;
    }
}
