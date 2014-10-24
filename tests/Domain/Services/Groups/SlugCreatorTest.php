<?php namespace Cribbb\Tests\Domain\Services\Groups;

use Cribbb\Domain\Model\Groups\Name;
use Cribbb\Domain\Model\Groups\Slug;
use Cribbb\Domain\Services\Groups\SlugCreator;

class SlugCreatorTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_create_slug_from_name()
    {
        $creator = new SlugCreator;

        $slug = $creator->create(new Name('Cribbb'));

        $this->assertEquals(new Slug('cribbb'), $slug);
    }
}
