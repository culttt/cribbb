<?php namespace Cribbb\Tests\Exceptions;

use Cribbb\Exceptions\BadRequestException;

class BadRequestExceptionTest extends \TestCase
{
    /** @test */
    public function should_create_exception()
    {
        $e = (new BadRequestException('bad_request'))->toArray();

        $this->assertArrayHasKey('id',     $e);
        $this->assertArrayHasKey('status', $e);
        $this->assertArrayHasKey('title',  $e);
        $this->assertArrayHasKey('detail', $e);
    }
}
