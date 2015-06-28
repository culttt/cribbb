<?php namespace Cribbb\Exceptions;

class PreconditionFailedException extends CribbbException
{
    /**
     * @var string
     */
    protected $status = '412';

    /**
     * @return void
     */
    public function __construct()
    {
        $message = $this->build(func_get_args());

        parent::__construct($message);
    }
}
