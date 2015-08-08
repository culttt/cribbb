<?php namespace Cribbb\Providers;

use Cribbb\Users\UserContext;
use Cribbb\Groups\GroupContext;
use Cribbb\Foundation\Context\Manager;
use Illuminate\Support\ServiceProvider;

class ContextServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any Context services
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any Context services
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('context', function () {
            return new Manager([
                'Group' => GroupContext::class,
                'User'  => UserContext::class
            ]);
        });

        $this->app->singleton(UserContext::class, function () {
            return new UserContext;
        });

        $this->app->singleton(GroupContext::class, function () {
            return new GroupContext;
        });
    }
}
