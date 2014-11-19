<?php namespace Cribbb\Tests\Domain\Model\Discussion;

use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;
use Cribbb\Domain\Model\Discussion\Participant;

class ParticipantTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserId */
    private $id;

    /** @var Email */
    private $email;

    /** @var Username */
    private $username;

    /** @var Participant */
    private $participant;

    public function setUp()
    {
        $this->id          = UserId::generate();
        $this->email       = new Email('name@domain.com');
        $this->username    = new Username('username');
        $this->participant = new Participant($this->id, $this->email, $this->username);
    }

    /** @test */
    public function should_require_user_id()
    {
        $this->setExpectedException('Exception');

        $participant = new Participant(null, $this->email, $this->username);
    }

    /** @test */
    public function should_require_email()
    {
        $this->setExpectedException('Exception');

        $participant = new Participant($this->id, null, $this->username);
    }

    /** @test */
    public function should_require_username()
    {
        $this->setExpectedException('Exception');

        $participant = new Participant($this->id, $this->email, null);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = new Participant($this->id, $this->email, $this->username);
        $two   = new Participant($this->id, $this->email, $this->username);
        $three = new Participant(UserId::generate(), new Email('other@domain.com'), new Username('other'));

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }
}
