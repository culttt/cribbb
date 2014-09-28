<?php namespace Cribbb\Infrastructure\Mailer;

class MailGunMailer implements Mailer
{
    /**
     * Send a Message
     *
     * @param Message $message
     * @return void
     */
    public function send(Message $message)
    {
        // Use the MailGun SDK to send the email
    }
}
