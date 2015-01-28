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
        $commandBasename = $this->classBasename($command);

        return str_replace(
            $commandBasename,
            str_replace('Command', 'Handler', $commandBasename),
            get_class($command)
        );
    }

    /**
     * Return basename of the given class, without any namespace names
     *
     * @param object|string $class
     * @return string
     */
    private function classBasename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}
