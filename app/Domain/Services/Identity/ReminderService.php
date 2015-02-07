<?php namespace Cribbb\Domain\Services\Identity;

use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\Reminder;
use Cribbb\Domain\Model\Identity\Password;
use Cribbb\Domain\Model\Identity\ReminderCode;
use Cribbb\Domain\Model\InvalidValueException;
use Cribbb\Domain\Model\ValueNotFoundException;
use Cribbb\Domain\Model\Identity\UserRepository;
use Cribbb\Domain\Model\Identity\ReminderRepository;

class ReminderService
{
    /**
     * @var ReminderRepository
     */
    private $reminders;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var HashingService
     */
    private $hasher;

    /**
     * Create a new ReminderService
     *
     * @param ReminderRepository $reminders
     * @param UserRepository $users
     * @return void
     */
    public function __construct(ReminderRepository $reminders, UserRepository $users, HashingService $hasher)
    {
        $this->reminders = $reminders;
        $this->users     = $users;
        $this->hasher    = $hasher;
    }

    /**
     * Request a password reminder Token
     *
     * @param string $email
     * @return Reminder
     */
    public function request($email)
    {
        $email = Email::fromNative($email);

        $this->findUserByEmail($email);

        $this->reminders->deleteExistingRemindersForEmail($email);

        $id = $this->reminders->nextIdentity();

        $reminder = new Reminder($id, $email, ReminderCode::generate());

        $this->reminders->add($reminder);

        return $reminder;
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
        $code  = ReminderCode::fromNative($code);
        $email = Email::fromNative($email);

        $reminder = $this->reminders->findReminderByEmailAndCode($email, $code);

        if ($reminder && $reminder->isValid()) return true;

        return false;
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
        if ($this->check($email, $code)) {
            $user = $this->findUserByEmail(Email::fromNative($email));

            $password = $this->hasher->hash(new Password($password));

            $user->resetPassword($password);

            $this->users->update($user);

            $this->reminders->deleteReminderByCode(ReminderCode::fromNative($code));

            return $user;
        }

        throw new InvalidValueException("$code is not a valid reminder code");
    }

    /**
     * Attempt to find a user by their email address
     *
     * @param Email $email
     * @return User
     */
    private function findUserByEmail(Email $email)
    {
        $user = $this->users->userOfEmail($email);

        if ($user) return $user;

        throw new ValueNotFoundException("$email is not a registered email address");
    }
}
