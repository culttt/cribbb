<?php namespace Cribbb\Foundation\Guards;

trait Guards
{
    /**
     * Run the Guards
     *
     * @param array $guards
     * @param array $args
     * @return void
     */
    public function guard(array $guards, array $args)
    {
        array_map(function ($guard) use ($args) {
            app($guard)->handle($args);
        }, $guards);
    }
}
