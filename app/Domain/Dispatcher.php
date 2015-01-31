<?php namespace Cribbb\Domain;

class Dispatcher
{
    /**
     * @var array
     */
    private $listeners;

    /**
     * Add a Listener
     *
     * @param string $name
     * @param Listener $listener
     * @return void
     */
    public function add($name, Listener $listener)
    {
        $this->listeners[$name][] = $listener;
    }

    /**
     * Return the registered Listeners for a given Event name
     *
     * @param string $name
     * @return array
     */
    public function registered($name)
    {
        if (isset($this->listeners[$name])) {
            return $this->listeners[$name];
        }

        return [];
    }

    /**
     * Dispatch an array of Events
     *
     * @param array $events
     * @return void
     */
    public function dispatch(array $events)
    {
        foreach ($events as $event) {
            $this->fire($event);
        }
    }

    /**
     * Fire the Event to each registered Listener
     *
     * @param Event $event
     * @return void
     */
    private function fire(Event $event)
    {
        foreach ($this->registered($event->name()) as $listener) {
             $listener->handle($event);
        }
    }
}
