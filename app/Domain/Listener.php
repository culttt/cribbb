<?php namespace Cribbb\Domain;

interface Listener
{
    /**
     * Handler a Domain Event
     *
     * @return void
     */
    public function handle(Event $event);
}