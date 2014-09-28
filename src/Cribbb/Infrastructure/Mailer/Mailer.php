<?php namespace Cribbb\Infrastructure\Mailer;

interface Mailer
{
    /**
     * Send a Message
     *
     * @param Message $message
     * @return void
     */
    public function send(Message $message);
}
