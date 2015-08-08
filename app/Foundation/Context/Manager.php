<?php namespace Cribbb\Foundation\Context;

use Cribbb\Foundation\Context\Exceptions\InvalidContext;

class Manager
{
    /**
     * @var array
     */
    private $contexts;

    /**
     * @param array $contexts
     * @return void
     */
    public function __construct(array $contexts)
    {
        $this->contexts = $contexts;
    }

    /**
     * Return the Context
     *
     * @param string $key
     * @return Context
     */
    public function get($key)
    {
        $context = array_get($this->contexts, $key);

        if ($context) {
            return app($context);
        }

        throw new InvalidContext(sprintf('%s is not a valid Context', $key));
    }
}
