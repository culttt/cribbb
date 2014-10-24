<?php namespace Cribbb\Tests\Domain\Services\Identity;

use Mockery as m;
use Carbon\Carbon;
use Cribbb\Domain\Model\Identity\User;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Identity\Reminder;
use Cribbb\Domain\Model\Identity\ReminderId;
use Cribbb\Domain\Model\Identity\ReminderCode;
use Cribbb\Domain\Model\Identity\HashedPassword;
use Cribbb\Domain\Services\Identity\ReminderService;

class ReminderServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @var ReminderRepository */
    private $reminders;

    /** @var UserRepository */
    private $users;

    /** @var ReminderService */
    private $service;

    /** @var User */
    private $user;

    /** @var array */
    private $fixture;

    public function setUp()
    {
        $id         = UserId::generate();
        $email      = new Email('name@domain.com');
        $username   = new Username('username');
        $password   = new HashedPassword('qwerty123');
        $this->user = User::register($id, $email, $username, $password);

        $this->fixture = [
            'id'    => ReminderId::generate(),
            'code'  => ReminderCode::generate(),
            'email' => new Email('name@domain.com')
        ];

        $this->users     = m::mock('Cribbb\Domain\Model\Identity\UserRepository');
        $this->reminders = m::mock('Cribbb\Domain\Model\Identity\ReminderRepository');
        $this->hasher    = m::mock('Cribbb\Domain\Services\Identity\HashingService');

        $this->service = new ReminderService($this->reminders, $this->users, $this->hasher);
    }

    /** @test */
    public function should_throw_exception_when_user_does_not_exist()
    {
        $this->setExpectedException('Cribbb\Domain\Model\ValueNotFoundException');

        $this->users->shouldReceive('userOfEmail')->andReturn(null);

        $this->service->request('nope@domain.com');
    }

    /** @test */
    public function should_request_and_return_new_reminder()
    {
        $this->users->shouldReceive('userOfEmail')->andReturn($this->user);
        $this->reminders->shouldReceive('deleteExistingRemindersForEmail');
        $this->reminders->shouldReceive('nextIdentity')->andReturn(ReminderId::generate());
        $this->reminders->shouldReceive('add');

        $reminder = $this->service->request('name@domain.com');
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\Reminder', $reminder);
    }

    /** @test */
    public function should_find_reminder_and_return_true_when_valid()
    {
        $reminder = new Reminder(
            $this->fixture['id'],
            $this->fixture['email'],
            $this->fixture['code']
        );

        $this->reminders->shouldReceive('findReminderByEmailAndCode')->andReturn($reminder);

        $this->assertTrue($this->service->check('name@domain.com', 'abc123'));
    }

    /** @test */
    public function should_find_reminder_and_return_false_when_invalid()
    {
        Carbon::setTestNow(Carbon::create(2014, 10, 11, 10, 23, 34));
        $reminder = new Reminder(
            $this->fixture['id'],
            $this->fixture['email'],
            $this->fixture['code']
        );
        Carbon::setTestNow();

        $this->reminders->shouldReceive('findReminderByEmailAndCode')->andReturn($reminder);

        $this->assertFalse($this->service->check('name@domain.com', 'abc123'));
    }

    /** @test */
    public function should_throw_exception_during_reset_attempt_when_email_or_code_are_invalid()
    {
        $this->setExpectedException('Cribbb\Domain\Model\InvalidValueException');

        $this->reminders->shouldReceive('findReminderByEmailAndCode')->andReturn(null);

        $this->service->reset('name@domain.com', 'qwerty123', 'abc123');
    }

    /** @test */
    public function should_reset_password_and_return_user()
    {
        $reminder = new Reminder(
            $this->fixture['id'],
            $this->fixture['email'],
            $this->fixture['code']
        );
        $this->reminders->shouldReceive('findReminderByEmailAndCode')->andReturn($reminder);
        $this->users->shouldReceive('userOfEmail')->andReturn($this->user);
        $this->hasher->shouldReceive('hash')->andReturn(new HashedPassword('qwerty123'));
        $this->users->shouldReceive('update');
        $this->reminders->shouldReceive('deleteReminderByCode');

        $user = $this->service->reset('name@domain.com', 'qwerty123', 'abc123');
        $this->assertInstanceOf('Cribbb\Domain\Model\Identity\User', $user);
    }
}
