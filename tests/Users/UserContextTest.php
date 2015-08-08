<?php namespace Cribbb\Tests\Users;

use Cribbb\Users\UserContext;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserContextTest extends \TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function should_return_false_when_context_is_not_set()
    {
        $context = new UserContext;

        $this->assertFalse($context->check());
    }

    /** @test */
    public function should_set_the_context()
    {
        $context = new UserContext;

        $context->set(factory('Cribbb\Users\User')->make());

        $this->assertTrue($context->check());
    }

    /** @test */
    public function should_get_the_id_of_the_context()
    {
        $context = new UserContext;

        $context->set(factory('Cribbb\Users\User')->create());

        $this->assertEquals(1, $context->id());
    }

    /** @test */
    public function should_get_the_model()
    {
        $context = new UserContext;

        $context->set(factory('Cribbb\Users\User')->make());

        $this->assertInstanceOf('Cribbb\Users\User', $context->model());
    }

    /** @test */
    public function should_be_returned_unknown_context_when_context_is_not_set()
    {
        $context = new UserContext;

        $this->assertInstanceOf('Cribbb\Foundation\Context\UnknownContext', $context->model());
    }
}
