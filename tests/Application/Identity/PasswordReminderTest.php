<?php namespace Cribbb\Tests\Application\Identity;

use Mockery as m;
use Illuminate\Hashing\BcryptHasher;
use Cribbb\Domain\Model\Identity\ReminderId;
use Cribbb\Application\Identity\PasswordReminder;
use Cribbb\Domain\Services\Identity\ReminderService;
use Cribbb\Infrastructure\Services\Identity\BcryptHashingService;

class PasswordReminderTest extends \TestCase
{
    /** @var PasswordReminder */
    private $service;

    /** @var UserRepository */
    private $users;

    /** @var ReminderRepository */
    private $reminders;

    public function setUp()
    {
        parent::setUp();

        $this->users     = m::mock('Cribbb\Domain\Model\Identity\UserRepository');
        $this->reminders = m::mock('Cribbb\Domain\Model\Identity\ReminderRepository');

        $this->service = new PasswordReminder(
            new ReminderService(
                $this->reminders,
                $this->users,
                new BcryptHashingService(new BcryptHasher)
            )
        );
    }

    /** @test */
    public function should_check_valid_email_address()
    {
        $this->assertEquals(null, $this->service->request('not_a_valid_email'));
        $this->assertEquals(1, $this->service->errors()->count());
    }

    /** @test */
    public function should_fail_request_with_unregistered_email()
    {
        $this->users->shouldReceive('userOfEmail')->once()->andReturn(null);

        $this->assertEquals(null, $this->service->request('name@domain.com'));
        $this->assertEquals(1, $this->service->errors()->count());
        $this->assertEquals(
            'name@domain.com is not a registered email address',
            $this->service->errors()->first());
    }

    /** @test */
    public function should_create_new_reminder_on_request()
    {
        $this->users->shouldReceive('userOfEmail')->once()->andReturn(true);
        $this->reminders->shouldReceive('deleteExistingRemindersForEmail')->once();
        $this->reminders->shouldReceive('nextIdentity')->once()->andReturn(ReminderId::generate());
        $this->reminders->shouldReceive('add')->once();

        $reminder = $this->service->request('name@domain.com');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Reminder', $reminder);
    }

    /** @test */
    public function should_check_for_invalid_email_or_reminder_code()
    {
        $this->reminders->shouldReceive('findReminderByEmailAndCode')->andReturn(null);

        $this->assertFalse($this->service->check('name@domain.com', 'abc123'));
    }

    /** @test */
    public function should_check_for_valid_email_and_reminder_code()
    {
        $reminder = m::mock('Cribbb\Domain\Model\Identity\Reminder');
        $reminder->shouldReceive('isValid')->andReturn(true);
        $this->reminders->shouldReceive('findReminderByEmailAndCode')->andReturn($reminder);

        $this->assertTrue($this->service->check('name@domain.com', 'abc123')); 
    }

    /** @test */
    public function should_return_error_on_invalid_token_during_reset()
    {
        $this->reminders->shouldReceive('findReminderByEmailAndCode')->andReturn(null);

        $this->assertEquals(null, $this->service->reset('name@domain.com', 'password', 'abc123'));
        $this->assertEquals(1, $this->service->errors()->count());
        $this->assertEquals(
            'abc123 is not a valid reminder code', $this->service->errors()->first());
    }

    /** @test */
    public function should_reset_password_and_return_user()
    {
        $reminder = m::mock('Cribbb\Domain\Model\Identity\Reminder');
        $reminder->shouldReceive('isValid')->andReturn(true);
        $this->reminders->shouldReceive('findReminderByEmailAndCode')->andReturn($reminder);

        $user = m::mock('Cribbb\Domain\Model\Identity\User');
        $this->users->shouldReceive('userOfEmail')->once()->andReturn($user);
        $user->shouldReceive('resetPassword')->once();

        $this->users->shouldReceive('update')->once();

        $this->reminders->shouldReceive('deleteReminderByCode')->once();

        $user = $this->service->reset('name@domain.com', 'password', 'abc123');

        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $user);
    }
}