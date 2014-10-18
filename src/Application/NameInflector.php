<?php namespace Cribbb\Application;

class NameInflector implements Inflector
{
    /**
     * Find a Handler for a Command
     *
     * @param Command $command
     * @return string
     */
    public function inflect(Command $command)
    {
        return str_replace('Command', 'Handler', get_class($command));
    }
}
