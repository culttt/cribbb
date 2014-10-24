<?php namespace Cribbb\Tests\Domain\Model\Groups;

use Cribbb\Domain\Model\Groups\Slug;

class SlugTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_require_slug()
    {
        $this->setExpectedException('Exception');
        $slug = new Slug;
    }

    /** @test */
    public function should_require_valid_slug()
    {
        $this->setExpectedException('Assert\AssertionFailedException');
        $slug = new Slug('???');
    }

    /** @test */
    public function should_accept_valid_slug()
    {
        $slug = new Slug('cribbb');
        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Slug', $slug);
    }

    /** @test */
    public function should_create_from_native()
    {
        $slug = Slug::fromNative('cribbb');

        $this->assertInstanceOf('Cribbb\Domain\Model\Groups\Slug', $slug);
    }

    /** @test */
    public function should_test_equality()
    {
        $one   = new Slug('cribbb');
        $two   = new Slug('cribbb');
        $three = new Slug('twitter');

        $this->assertTrue($one->equals($two));
        $this->assertFalse($one->equals($three));
    }

    /** @test */
    public function should_return_as_string()
    {
        $slug = new Slug('cribbb');

        $this->assertEquals('cribbb', $slug->toString());
        $this->assertEquals('cribbb', (string) $slug);
    }
}
