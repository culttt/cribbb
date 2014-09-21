<?php namespace Cribbb\Application\Identity;

use Cribbb\Gettable;

class ResetPasswordCommand
{
    use Gettable;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $code;

    /**
     * Create a new ResetPasswordCommand
     *
     * @param string $email
     * @param string $password
     * @param string $code
     * @return void
     */
    public function __construct($email, $password, $code)
    {
        $this->email    = $email;
        $this->password = $password;
        $this->code     = $code;
    }
}
