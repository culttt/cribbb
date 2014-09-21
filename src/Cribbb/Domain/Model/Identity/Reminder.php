<?php namespace Cribbb\Domain\Model\Identity;

use Carbon\Carbon;
use Cribbb\Gettable;
use Cribbb\Domain\HasEvents;
use Cribbb\Domain\ValueObject;
use Cribbb\Domain\Model\Identity\Events\PasswordReminderCreated;

class Reminder implements ValueObject
{
    use Gettable;
    use HasEvents;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var ReminderCode
     */
    private $code;

    /**
     * @var Carbon
     */
    private $timestamp;

    /**
     * Create a new Reminder
     *
     * @param Email $email
     * @param ReminderCode $code
     * @param string $timestamp
     * @return void
     */
    public function __construct(Email $email, ReminderCode $code, Carbon $timestamp = null)
    {
        $this->email     = $email;
        $this->code      = $code;
        $this->timestamp = $timestamp ? $timestamp : Carbon::now();

        $this->record(new PasswordReminderCreated($this));
    }

    /**
     * Create a Reminder from it's native form
     *
     * @param string $email
     * @param string $code
     * @param string $timestamp
     * @return Reminder
     */
    public static function fromNative($email, $code, $timestamp)
    {
        $email     = Email::fromNative($email);
        $code      = ReminderCode::fromNative($code);
        $timestamp = Carbon::createFromFormat('Y-m-d H:i:s', $timestamp);

        return new static($email, $code, $timestamp);
    }

    /**
     * Check to see if the Reminder is valid
     *
     * @return bool
     */
    public function isValid()
    {
        return Carbon::now()->subHour()->lt($this->timestamp);
    }

    /**
     * Determine equality with another Value Object
     *
     * @param ValueObject $object
     * @return bool
     */
    public function equals(ValueObject $object)
    {
        return get_class($object) == get_class($object)
               && $this->email    == $object->email
               && $this->code     == $object->code
               && $this->timestamp->eq($object->timestamp);
    }
}
