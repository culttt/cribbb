<?php namespace Cribbb\Foundation\Context;

use Cribbb\Foundation\Context\Exceptions\ContextNotSet;

class UnknownContext
{
    /**
     * @var string
     */
    private $type;

    /**
     * @param string $type
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Catch all method calls
     *
     * @param string $name
     * @param mixed $arguments
     * @return void
     */
    public function __call($name, $arguments)
    {
        $this->handle();
    }

    /**
     * Catch all get calls
     *
     * @param string $name
     * @return void
     */
    public function __get($name)
    {
        $this->handle();
    }

    /**
     * Catch all set calls
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public function __set($name, $value)
    {
        $this->handle();
    }

    /**
     * Handle all calls to the class
     *
     * @return void
     */
    private function handle()
    {
        throw new ContextNotSet(
            sprintf('The Context type %s has not been set', $this->type));
    }
}
