<?php namespace Cribbb\Application\Identity;

use Cribbb\Gettable;

class RequestReminderCommand
{
    use Gettable;

    /**
     * @var string
     */
    private $email;

    /**
     * Create a new RequestReminderCommand
     *
     * @param string $email
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }
}
