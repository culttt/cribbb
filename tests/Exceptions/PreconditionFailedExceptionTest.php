<?php namespace Cribbb\Tests\Exceptions;

use Cribbb\Exceptions\PreconditionFailedException;

class PreconditionFailedExceptionTest extends \TestCase
{
    /** @test */
    public function should_create_exception()
    {
        $e = (new PreconditionFailedException('precondtion_failed'))->toArray();

        $this->assertArrayHasKey('id',     $e);
        $this->assertArrayHasKey('status', $e);
        $this->assertArrayHasKey('title',  $e);
        $this->assertArrayHasKey('detail', $e);
    }
}
