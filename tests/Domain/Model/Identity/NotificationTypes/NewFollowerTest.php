<?php namespace Cribbb\Tests\Domain\Model\Identity\NotificationTypes;

use Cribbb\Domain\Model\Identity\NotificationTypes\NewFollower;

class NewFollowerTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function should_return_tag()
    {
        $type = new NewFollower;

        $this->assertEquals('new_follower', $type->tag());
    }
}
