<?php namespace Cribbb\Infrastructure\Mailer;

interface Message
{
    /**
     * Return the recipient
     *
     * @return string
     */
    public function to();

    /**
     * Return the sender
     *
     * @return string
     */
    public function from();

    /**
     * Return the subject
     *
     * @return string
     */
    public function subject();

    /**
     * Return the body
     *
     * @return string
     */
    public function body();
}
