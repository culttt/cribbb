<?php namespace Way\Generators\Commands;

use Way\Generators\Generators\ResourceGenerator;
use Way\Generators\Cache;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Pluralizer;

class MissingTableFieldsException extends \Exception {}

class ScaffoldGeneratorCommand extends ResourceGeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:scaffold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate scaffolding for a resource.';

    /**
     * Get the path to the template for a model
     *
     * @return string
     */
    protected function getModelTemplatePath()
    {
        return __DIR__.'/../Generators/templates/scaffold/model.txt';
    }

    /**
     * Get the path to the template for a controller
     *
     * @return string
     */
    protected function getControllerTemplatePath()
    {
        return __DIR__.'/../Generators/templates/scaffold/controller.txt';
    }

    /**
     * Get the path to the template for a view
     *
     * @return string
     */
    protected function getViewTemplatePath($view = 'view')
    {
        return __DIR__."/../Generators/templates/scaffold/views/{$view}.txt";
    }

}