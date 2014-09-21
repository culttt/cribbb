<?php namespace Cribbb\Tests\Domain\Model\Identity;

use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\Reminder;
use Cribbb\Domain\Model\Identity\ReminderCode;

class ReminderTest extends \PHPUnit_Framework_TestCase
{
    /** @var Reminder */
    private $reminder;

    public function setUp()
    {
        $email = new Email('name@domain.com');
        $code  = ReminderCode::generate();
        $this->reminder = new Reminder($email, $code);
    }

    /** @test */
    public function should_create_a_new_reminder()
    {
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Reminder', $this->reminder);
    }

    /** @test */
    public function should_create_reminder_from_native()
    {
        $email     = 'name@domain.com';
        $code      = 'D1zcA5ncaEHzmjvCGjJIt3Kd8sGxTTtE7DkathqB';
        $timestamp = '2014-09-21 13:32:12';
        $reminder  = Reminder::fromNative($email, $code, $timestamp);

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Reminder', $reminder);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = Reminder::fromNative('name@domain.com', 'abc123', '2014-09-21 13:32:12');
        $two   = Reminder::fromNative('name@domain.com', 'abc123', '2014-09-21 13:32:12');
        $three = Reminder::fromNative('name@domain.com', 'abc123', '2014-09-21 13:32:13');

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_check_for_validity()
    {
        $other = Reminder::fromNative('name@domain.com', 'abc123', '2014-09-21 12:32:12');

        $this->assertTrue($this->reminder->isValid());
        $this->assertFalse($other->isValid());
    }
}
