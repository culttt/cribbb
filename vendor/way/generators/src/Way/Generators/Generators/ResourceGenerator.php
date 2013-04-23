<?php

namespace Way\Generators\Generators;

use Illuminate\Filesystem\Filesystem as File;
use Illuminate\Support\Pluralizer;

class ResourceGenerator {

    /**
     * File system instance
     *
     * @var File
     */
    protected $file;

    /**
     * Constructor
     *
     * @param $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Update app/routes.php
     *
     * @param  string $name
     * @return void
     */
    public function updateRoutesFile($name)
    {
        $name = strtolower(Pluralizer::plural($name));

        $this->file->append(
            app_path() . '/routes.php',
            "\n\nRoute::resource('" . $name . "', '" . ucwords($name) . "Controller');"
        );
    }

    /**
     * Create any number of folders
     *
     * @param  string|array $folders
     * @return void
     */
    public function folders($folders)
    {
        foreach((array) $folders as $folderPath)
        {
            if (! $this->file->exists($folderPath))
            {
                $this->file->makeDirectory($folderPath);
            }
        }
    }

}
