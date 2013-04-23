<?php namespace Way\Generators\Commands;

use Way\Generators\Generators\FormDumperGenerator;
use Illuminate\Console\Command;
use Mustache_Engine as Mustache;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem as File;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class FormDumperCommand extends BaseGeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:form';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump form HTML for a model';

    /**
     * FormDumper generator instance
     *
     * @var Way\Generators\Generators\FormDumperGenerator
     */
    protected $generator;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FormDumperGenerator $generator)
    {
        parent::__construct();

        $this->generator = $generator;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        if (! class_exists($model = $this->argument('model')))
        {
            throw new \InvalidArgumentException('Model does not exist!');
        }

        $this->generator->make(
            $model,
            $this->option('method'),
            $this->option('html')
        );
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('model', InputArgument::REQUIRED, 'Name of the model for the form.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('method', null, InputOption::VALUE_OPTIONAL, 'What operation are we doing? [create|edit]', 'create'),
            array('html', null, InputOption::VALUE_OPTIONAL, 'Which HTML element should be used?', 'ul')
        );
    }

}