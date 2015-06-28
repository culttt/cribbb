<?php namespace Cribbb\Exceptions;

class BadRequestException extends CribbbException
{
    /**
     * @var string
     */
    protected $status = '400';

    /**
     * @return void
     */
    public function __construct()
    {
        $message = $this->build(func_get_args());

        parent::__construct($message);
    }
}
