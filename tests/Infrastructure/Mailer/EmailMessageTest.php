<?php namespace Cribbb\Tests\Infrastructure\Mailer;

use Cribbb\Infrastructure\Mailer\EmailMessage;

class EmailMessageTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_create_email_message()
    {
        $to      = 'name@domain.com';
        $from    = 'other@domain.com';
        $subject = 'Hello World';
        $body    = '<h1>Hello World</h1>';

        $message = new EmailMessage($to, $from, $subject, $body);

        $this->assertEquals($to,      $message->to());
        $this->assertEquals($from,    $message->from());
        $this->assertEquals($subject, $message->subject());
        $this->assertEquals($body,    $message->body());
    }
}
