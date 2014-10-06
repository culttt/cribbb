<?php namespace Cribbb\Application;

class CommandBus
{
    /**
     * @var Container
     */
    private $container;

    /**
     * Create a new CommandBus
     *
     * @param Container $container
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Execute a Command by passing it to a Handler
     *
     * @param Command $command
     * @return void
     */
    public function execute(Command $command){}
}
