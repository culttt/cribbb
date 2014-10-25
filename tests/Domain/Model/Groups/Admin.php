<?php namespace Cribbb\Tests\Domain\Model\Groups;

use Cribbb\Domain\Model\Groups\Admin;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;

class AdminTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserId */
    private $id;

    /** @var Email */
    private $email;

    /** @var Username */
    private $username;

    /** @var Admin */
    private $admin;

    public function setUp()
    {
        $this->id       = UserId::generate();
        $this->email    = new Email('name@domain.com');
        $this->username = new Username('username');
        $this->admin    = new Admin($this->id, $this->email, $this->username);
    }

    /** @test */
    public function should_require_user_id()
    {
        $this->setExpectedException('Exception');

        $admin = new Admin(null, $this->email, $this->username);
    }

    /** @test */
    public function should_require_email()
    {
        $this->setExpectedException('Exception');

        $admin = new Admin($this->id, null, $this->username);
    }

    /** @test */
    public function should_require_username()
    {
        $this->setExpectedException('Exception');

        $admin = new Admin($this->id, $this->email, null);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = new Admin($this->id, $this->email, $this->username);
        $two   = new Admin($this->id, $this->email, $this->username);
        $three = new Admin(UserId::generate(), new Email('other@domain.com'), new Username('other'));

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }
}
