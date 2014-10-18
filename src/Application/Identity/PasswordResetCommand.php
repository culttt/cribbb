<?php namespace Cribbb\Application\Identity;

use Cribbb\Gettable;
use Cribbb\Application\Command;

class PasswordResetCommand implements Command
{
    use Gettable;

    /**
     * @var string
     */
    private $email;

    /**
     * Create a new PasswordResetCommand
     *
     * @param string $email
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }
}
