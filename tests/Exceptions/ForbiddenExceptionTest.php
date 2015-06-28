<?php namespace Cribbb\Tests\Exceptions;

use Cribbb\Exceptions\ForbiddenException;

class ForbiddenExceptionTest extends \TestCase
{
    /** @test */
    public function should_create_exception()
    {
        $e = (new ForbiddenException('forbidden'))->toArray();

        $this->assertArrayHasKey('id',     $e);
        $this->assertArrayHasKey('status', $e);
        $this->assertArrayHasKey('title',  $e);
        $this->assertArrayHasKey('detail', $e);
    }
}
