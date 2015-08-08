<?php namespace Cribbb\Tests\Foundation\Context;

use Cribbb\Foundation\Context\Manager;

class ManagerContextTest extends \TestCase
{
    /** @test */
    public function should_throw_exception_when_getting_invalid_context()
    {
        $this->setExpectedException('Cribbb\Foundation\Context\Exceptions\InvalidContext');

        $manager = new Manager([]);

        $manager->get('Invalid');
    }

    /** @test */
    public function should_return_context()
    {
        $manager = new Manager(['User' => 'Cribbb\Users\UserContext']);

        $context = $manager->get('User');

        $this->assertInstanceOf('Cribbb\Foundation\Context\Context', $context);
    }
}
