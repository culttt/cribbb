<?php

namespace Way\Generators\Generators;

use Way\Generators\Cache;
use Illuminate\Filesystem\Filesystem as File;

class RequestedCacheNotFound extends \Exception {}

abstract class Generator {

    /**
     * File path to generate
     *
     * @var string
     */
    public $path;

    /**
     * File system instance
     * @var File
     */
    protected $file;

    /**
     * Cache
     * @var Cache
     */
    protected $cache;

    /**
     * Constructor
     *
     * @param $file
     */
    public function __construct(File $file, Cache $cache)
    {
        $this->file = $file;
        $this->cache = $cache;
    }

    /**
     * Compile template and generate
     *
     * @param  string $path
     * @param  string $template Path to tempalte
     * @return boolean
     */
    public function make($path, $template)
    {
        $this->name = basename($path, '.php');
        $this->path = $this->getPath($path);
        $template = $this->getTemplate($template, $this->name);

        if (! $this->file->exists($this->path))
        {
            return $this->file->put($this->path, $template) !== false;
        }

        return false;
    }

    /**
     * Get the path to the file
     * that should be gereated
     *
     * @param  string $path
     * @return string
     */
    protected function getPath($path)
    {
        // By default, we won't do anything, but
        // it can be overriden from a child class
        return $path;
    }

    /**
     * Determines whether the specified template
     * points to the scaffolds directory
     *
     * @param  string $template
     * @return boolean
     */
    protected function needsScaffolding($template)
    {
        return str_contains($template, 'scaffold');
    }

    /**
     * Get compiled template
     *
     * @param  string $template
     * @param  $name Name of file
     * @return string
     */
    abstract protected function getTemplate($template, $name);
}