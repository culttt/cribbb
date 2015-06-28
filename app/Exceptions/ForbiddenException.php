<?php namespace Cribbb\Exceptions;

class ForbiddenException extends CribbbException
{
    /**
     * @var string
     */
    protected $status = '403';

    /**
     * @return void
     */
    public function __construct()
    {
        $message = $this->build(func_get_args());

        parent::__construct($message);
    }
}
