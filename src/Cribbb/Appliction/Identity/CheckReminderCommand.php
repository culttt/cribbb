<?php namespace Cribbb\Application\Identity;

use Cribbb\Gettable;

class CheckReminderCommand
{
    use Gettable;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $code;

    /**
     * Create a new CheckReminderCommand
     *
     * @param string $email
     * @param string $code
     * @return void
     */
    public function __construct($email, $code)
    {
        $this->email = $email;
        $this->code  = $code;
    }
}
