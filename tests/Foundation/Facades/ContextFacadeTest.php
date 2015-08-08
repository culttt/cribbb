<?php namespace Cribbb\Foundation\Facades;

use Cribbb\Foundation\Facades\Context;

class ContextFacadeTest extends \TestCase
{
    /** @test */
    public function should_resolve_context()
    {
        $this->assertInstanceOf('Cribbb\Users\UserContext', Context::get('User'));
    }
}
