<?php namespace Cribbb\Foundation\Guards;

use Exception;

abstract class Guard
{
    /**
     * Handle the Guard
     *
     * @param array $args
     * @return bool
     */
    abstract public function handle(array $args);

    /**
     * Get an argument from the `args` array
     *
     * @param string $key
     * @param array $args
     * @return mixed
     */
    protected function get($key, $args)
    {
        $arg = array_get($args, $key);

        if ($arg) return $arg;

        throw new Exception(sprintf('%s was not found in the `args` array'));
    }
}
