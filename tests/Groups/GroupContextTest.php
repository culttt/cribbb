<?php namespace Cribbb\Tests\Users;

use Cribbb\Groups\GroupContext;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GroupContextTest extends \TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function should_return_false_when_context_is_not_set()
    {
        $context = new GroupContext;

        $this->assertFalse($context->check());
    }

    /** @test */
    public function should_set_the_context()
    {
        $context = new GroupContext;

        $context->set(factory('Cribbb\Groups\Group')->make());

        $this->assertTrue($context->check());
    }

    /** @test */
    public function should_get_the_id_of_the_context()
    {
        $context = new GroupContext;

        $context->set(factory('Cribbb\Groups\Group')->create());

        $this->assertEquals(1, $context->id());
    }

    /** @test */
    public function should_get_the_model()
    {
        $context = new GroupContext;

        $context->set(factory('Cribbb\Groups\Group')->make());

        $this->assertInstanceOf('Cribbb\Groups\Group', $context->model());
    }

    /** @test */
    public function should_be_returned_unknown_context_when_context_is_not_set()
    {
        $context = new GroupContext;

        $this->assertInstanceOf('Cribbb\Foundation\Context\UnknownContext', $context->model());
    }
}
