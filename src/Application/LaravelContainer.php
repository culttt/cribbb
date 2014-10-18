<?php namespace Cribbb\Application;

use Illuminate\Container\Container as DependencyContainer;

class LaravelContainer implements Container
{
    /**
     * @var Container
     */
    private $container;

    /**
     * Create a new LaravelContainer
     *
     * @param Container $container
     * @return void
     */
    public function __construct(DependencyContainer $container)
    {
        $this->container = $container;
    }

    /**
     * Resolve the class out of the Container
     *
     * @param string $class
     * @return mixed
     */
    public function make($class)
    {
        return $this->container->make($class);
    }
}
