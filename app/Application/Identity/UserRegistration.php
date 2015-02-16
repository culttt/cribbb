<?php namespace Cribbb\Application\Identity;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Cribbb\Domain\Services\Identity\RegisterUserService;

class UserRegistration
{
    /**
     * @var RegisterUserService
     */
    private $service;

    /**
     * @var MessageBag
     */
    private $errors;

    /**
     * @var array
     */
    private $rules = [
        'email'    => 'email',
        'username' => 'alpha_dash'
    ];

    /**
     * @var RegisterUserService $service
     * @return void
     */
    public function __construct(RegisterUserService $service)
    {
        $this->service = $service;
        $this->errors  = new MessageBag;
    }

    /**
     * Register a new user
     *
     * @param string $email
     * @param string $username
     * @param string $password
     * @return User
     */
    public function register($email, $username, $password)
    {
        if ($this->validate(compact('email', 'username'))) {
            $user = $this->service->register($email, $username, $password);

            /* Dispatch Domain Events */

            return $user;
        }
    }

    /**
     * Validate the user's credentials
     *
     * @param array $data
     * @return bool
     */
    public function validate(array $data)
    {
        $data = array_only($data, ['email', 'username']);

        $validator = Validator::make($data, $this->rules);

        if ($validator->passes()) return true;

        $this->errors = $validator->messages();

        return false;
    }

    /**
     * Return the errors
     *
     * @return MessageBag
     */
    public function errors()
    {
        return $this->errors;
    }
}