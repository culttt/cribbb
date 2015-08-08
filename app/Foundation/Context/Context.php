<?php namespace Cribbb\Foundation\Context;

use Illuminate\Database\Eloquent\Model;

abstract class Context
{
    /**
     * @var Model
     */
    private $model;

    /**
     * @var string
     */
    protected static $type;

    /**
     * Check to see if the context has been set
     *
     * @return bool
     */
    public function check()
    {
        return ! is_null($this->model);
    }

    /**
     * Get the id of the context
     *
     * @return int
     */
    public function id()
    {
        if ($this->check()) {
            return $this->model->id;
        }
    }

    /**
     * Set the context
     *
     * @param Model $model
     * @return Context
     */
    public function set(Model $model)
    {
        $this->model = $model;

        return $this;
    }
    /**
     * Get the underlying Model
     *
     * @return Model
     */
    public function model()
    {
        if ($this->check()) {
            return $this->model;
        }

        return new UnknownContext(self::$type);
    }
}
