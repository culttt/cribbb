<?php namespace Cribbb\Application\Identity;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Cribbb\Domain\Model\InvalidValueException;
use Cribbb\Domain\Model\ValueNotFoundException;
use Cribbb\Domain\Services\Identity\ReminderService;

class PasswordReminder
{
    /**
     * @var ReminderService
     */
    private $service;

    /**
     * @var MessageBag
     */
    private $errors;

    /**
     * @param ReminderService $service
     * @return void
     */
    public function __construct(ReminderService $service)
    {
        $this->service = $service;
        $this->errors  = new MessageBag;  
    }

    /**
     * Request a new password reminder
     *
     * @param string $email
     * @return Reminder
     */
    public function request($email)
    {
        if ($this->validate($email)) {
            try {
                $reminder = $this->service->request($email);

                /* Dispatch Domain Events */

                return $reminder;
            }

            catch (ValueNotFoundException $e) {
                $this->errors()->add('email', $e->getMessage());
            }
        }
    }

    /**
     * Check to see if the email and token combination are valid
     *
     * @param string $email
     * @param string $code
     * @return bool
     */
    public function check($email, $code)
    {
        if ($this->validate($email)) {
            return $this->service->check($email, $code);
        }
    }

    /**
     * Reset a user's password
     *
     * @param string $email
     * @param string $password
     * @param string $code
     * @return User;
     */
    public function reset($email, $password, $code)
    {
        if ($this->validate($email)) {
            try {
                $user = $this->service->reset($email, $password, $code);

                /* Dispatch Domain Events */

                return $user;
            }

            catch (InvalidValueException $e) {
                $this->errors()->add('code', $e->getMessage());
            }
        }
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

    /**
     * Check that the email is valid
     *
     * @param string $email
     * @return bool
     */
    private function validate($email)
    {
        $validator = Validator::make(compact('email'), ['email' => 'email']);

        if ($validator->passes()) return true;

        $this->errors = $validator->messages();

        return false;
    }
}