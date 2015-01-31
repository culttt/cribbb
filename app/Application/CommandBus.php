<?php namespace Cribbb\Application;

class CommandBus
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var Inflector
     */
    private $inflector;

    /**
     * Create a new CommandBus
     *
     * @param Container $container
     * @return void
     */
    public function __construct(Container $container, Inflector $inflector)
    {
        $this->container = $container;
        $this->inflector = $inflector;
    }

    /**
     * Execute a Command by passing it to a Handler
     *
     * @param Command $command
     * @return void
     */
    public function execute(Command $command)
    {
        $this->handler($command)->handle($command);
    }

    /**
     * Get the Command Handler
     *
     * @return mixed
     */
    private function handler(Command $command)
    {
        $class = $this->inflector->inflect($command);

        return $this->container->make($class);
    }
}
