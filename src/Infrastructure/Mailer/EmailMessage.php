<?php namespace Cribbb\Infrastructure\Mailer;

class EmailMessage implements Message
{
    /**
     * The recipient
     *
     * @param string
     */
    private $to;

    /**
     * The sender
     *
     * @param string
     */
    private $from;

    /**
     * The subject
     *
     * @param $subject
     */
    private $subject;

    /**
     * The body of the message
     *
     * @param string
     */
    private $body;

    /**
     * Create a new Message
     *
     * @param string $to
     * @param string $from
     * @param string $subject
     * @param string $body
     */
    public function __construct($to, $from, $subject, $body)
    {
        $this->to      = $to;
        $this->from    = $from;
        $this->subject = $subject;
        $this->body    = $body;
    }

    /**
     * Return the recipient
     *
     * @return string
     */
    public function to()
    {
        return $this->to;
    }

    /**
     * Return the sender
     *
     * @return string
     */
    public function from()
    {
        return $this->from;
    }

    /**
     * Return the subject
     *
     * @return string
     */
    public function subject()
    {
        return $this->subject;
    }

    /**
     * Return the body
     *
     * @return string
     */
    public function body()
    {
        return $this->body;
    }
}
