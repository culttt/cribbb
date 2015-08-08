<?php namespace Cribbb\Foundation\Facades;

use Illuminate\Support\Facades\Facade;

class Context extends Facade
{
    /**
     * Get the registered name of the component
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'context';
    }
}
