<?php namespace Cribbb\Application\Identity;

use Cribbb\Gettable;
use Cribbb\Application\Command;

class RegisterUserCommand implements Command
{
    use Gettable;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * Create a new RegisterUserCommand
     *
     * @param string $email
     * @param string $username
     * @param string $password
     * @return void
     */
    public function __construct($email, $username, $password)
    {
        $this->email    = $email;
        $this->username = $username;
        $this->password = $password;
    }
}
