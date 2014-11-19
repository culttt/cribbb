<?php namespace Cribbb\Tests\Domain\Model\Discussion;

use Cribbb\Domain\Model\Discussion\Author;
use Cribbb\Domain\Model\Identity\Email;
use Cribbb\Domain\Model\Identity\UserId;
use Cribbb\Domain\Model\Identity\Username;

class AuthorTest extends \PHPUnit_Framework_TestCase
{
    /** @var UserId */
    private $id;

    /** @var Email */
    private $email;

    /** @var Username */
    private $username;

    /** @var Author */
    private $author;

    public function setUp()
    {
        $this->id       = UserId::generate();
        $this->email    = new Email('name@domain.com');
        $this->username = new Username('username');
        $this->author   = new Author($this->id, $this->email, $this->username);
    }

    /** @test */
    public function should_require_user_id()
    {
        $this->setExpectedException('Exception');

        $author = new Author(null, $this->email, $this->username);
    }

    /** @test */
    public function should_require_email()
    {
        $this->setExpectedException('Exception');

        $author = new Author($this->id, null, $this->username);
    }

    /** @test */
    public function should_require_username()
    {
        $this->setExpectedException('Exception');

        $author = new Author($this->id, $this->email, null);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = new Author($this->id, $this->email, $this->username);
        $two   = new Author($this->id, $this->email, $this->username);
        $three = new Author(UserId::generate(), new Email('other@domain.com'), new Username('other'));

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }
}
