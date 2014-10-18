<?php namespace Cribbb\Stubs;

use Cribbb\Application\Handler;
use Cribbb\Application\Command;

class HandlerStub implements Handler
{
    /**
     * Handle a Command object
     *
     * @param Command $command
     * @return void
     */
    public function handle(Command $command)
    {
       $counter = $command->counter();

       $counter->count++;
    }
}
