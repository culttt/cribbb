<?php namespace Cribbb\Tests\Domain\Services\Identity;

use Mockery as m;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\Reminder;
use Cribbb\Domain\Model\Identity\ReminderCode;
use Cribbb\Domain\Model\Identity\HashedPassword;
use Cribbb\Domain\Services\Identity\PasswordReminderService;

class PasswordReminderServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var PasswordReminderService */
    private $service;

    public function setUp()
    {
        $this->reminders = m::mock('Cribbb\Domain\Model\Identity\PasswordReminderRepository');
        $this->users     = m::mock('Cribbb\Domain\Model\Identity\UserRepository');
        $this->hasher    = m::mock('Cribbb\Domain\Services\Identity\HashingService');
        $this->user      = m::mock('Cribbb\Domain\Model\Identity\User');
        $this->expired   = Reminder::fromNative('name@domain.com', 'abc123', '2014-09-21 12:32:12');
        $this->valid     = new Reminder(new Email('name@domain.com'), ReminderCode::generate());

        $this->service = new PasswordReminderService($this->reminders, $this->users, $this->hasher);
    }

    /** @test */
    public function should_throw_exception_on_invalid_email()
    {
        $this->users->shouldReceive('userOfEmail')->andReturn(null);

        $this->setExpectedException('Cribbb\Domain\Model\ValueNotFoundException');

        $this->service->request('name@domain.com');
    }

    /** @test */
    public function should_return_new_reminder_on_request()
    {
        $this->users->shouldReceive('userOfEmail')->andReturn($this->user);
        $this->reminders->shouldReceive('deleteExistingRemindersForEmail');
        $this->reminders->shouldReceive('add');

        $reminder = $this->service->request('name@domain.com');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Reminder', $reminder);
    }

    /** @test */
    public function should_return_false_for_expired_reminder_check()
    {
        $this->reminders->shouldReceive('findReminderByEmailAndCode')->andReturn($this->expired);

        $this->assertFalse($this->service->check('name@domain.com', 'abc123'));
    }

    /** @test */
    public function should_return_true_for_valid_reminder_check()
    {
        $this->reminders->shouldReceive('findReminderByEmailAndCode')->andReturn($this->valid);

        $this->assertTrue($this->service->check('name@domain.com', 'abc123'));
    }

    /** @test */
    public function should_return_user_on_successful_password_reset()
    {
        $this->reminders->shouldReceive('findReminderByEmailAndCode')->andReturn($this->valid);
        $this->users->shouldReceive('userOfEmail')->andReturn($this->user);
        $this->hasher->shouldReceive('hash')->andReturn(new HashedPassword('password'));
        $this->user->shouldReceive('resetPassword');
        $this->users->shouldReceive('update');
        $this->reminders->shouldReceive('deleteReminderByCode');

        $user = $this->service->reset('name@domain.com', 'password', 'abc123');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $user);
    }
}
