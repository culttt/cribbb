<?php namespace Cribbb\Foundation\Context;

use Cribbb\Foundation\Context\UnknownContext;

class UnknownContextTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_throw_exception_on_method_calls()
    {
        $this->setExpectedException('Cribbb\Foundation\Context\Exceptions\ContextNotSet');

        $context = new UnknownContext('User');

        $context->method();
    }

    /** @test */
    public function should_throw_exception_when_getting_a_property()
    {
        $this->setExpectedException('Cribbb\Foundation\Context\Exceptions\ContextNotSet');

        $context = new UnknownContext('User');

        $context->name;
    }

    /** @test */
    public function should_throw_exception_when_setting_a_property()
    {
        $this->setExpectedException('Cribbb\Foundation\Context\Exceptions\ContextNotSet');

        $context = new UnknownContext('User');

        $context->name = 'John Appleseed';
    }
}
