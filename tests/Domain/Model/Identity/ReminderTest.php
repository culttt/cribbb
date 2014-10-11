<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Carbon\Carbon;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\Reminder;
use Cribbb\Domain\Model\Identity\ReminderId;
use Cribbb\Domain\Model\Identity\ReminderCode;

class ReminderTest extends \PHPUnit_Framework_TestCase
{
    /** @var ReminderId */
    private $id;

    /** @var Email */
    private $email;

    /** @var ReminderCode */
    private $code;

    /** @var Carbon */
    private $timestamp;

    /** @var Reminder */
    private $reminder;

    public function setUp()
    {
        $this->id        = ReminderId::generate();
        $this->email     = new Email('name@domain.com');
        $this->code      = ReminderCode::generate();
        $this->timestamp = Carbon::create(2014, 10, 11, 10, 23, 34);

        Carbon::setTestNow($this->timestamp);

        $this->reminder = new Reminder($this->id, $this->email, $this->code);
    }

    /** @test */
    public function should_create_reminder()
    {
        $this->assertEquals($this->id,        $this->reminder->id());
        $this->assertEquals($this->email,     $this->reminder->email());
        $this->assertEquals($this->code,      $this->reminder->code());
        $this->assertEquals($this->timestamp, $this->reminder->createdAt());
    }

    /** @test */
    public function should_be_valid_when_not_expired()
    {
        $this->assertTrue($this->reminder->isValid());
    }

    /** @test */
    public function should_be_invalid_when_expired()
    {
        Carbon::setTestNow(Carbon::create(2014, 10, 11, 10, 23, 34));

        $reminder = new Reminder($this->id, $this->email, $this->code);

        Carbon::setTestNow(Carbon::create(2014, 10, 11, 11, 25, 12));

        $this->assertFalse($reminder->isValid());
    }
}
