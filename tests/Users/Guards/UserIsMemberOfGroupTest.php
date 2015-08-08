<?php namespace Cribbb\Tests\Users\Guards;

use Cribbb\Users\Guards\UserIsMemberOfGroup;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserIsMemberOfGroupTest extends \TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function should_throw_exception_when_user_does_not_belong_to_group()
    {
        $this->setExpectedException('Cribbb\Users\Exceptions\UserDoesNotBelongToGroup');

        $user  = factory('Cribbb\Users\User')->create();
        $group = factory('Cribbb\Groups\Group')->create();

        $guard = new UserIsMemberOfGroup;
        $guard->handle(compact('user', 'group'));
    }

    /** @test */
    public function should_return_true_when_user_does_belong_to_group()
    {
        $user  = factory('Cribbb\Users\User')->create();
        $group = factory('Cribbb\Groups\Group')->create();

        $user->groups()->save($group);

        $guard = new UserIsMemberOfGroup;
        $guard->handle(compact('user', 'group'));
    }
}
