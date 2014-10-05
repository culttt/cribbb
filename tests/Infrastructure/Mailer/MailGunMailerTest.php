<?php namespace Cribbb\Tests\Infrastructure\Mailer;

use Cribbb\Infrastructure\Mailer\MailGunMailer;

class MailGunMailerTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_instance_of_message()
    {
        $this->setExpectedException('Exception');

        $mailer = new MailGunMailer;
        $mailer->send([]);
    }
}
