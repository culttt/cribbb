<?php namespace Way\Generators\Commands;

use Way\Generators\Generators\SeedGenerator;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SeedGeneratorCommand extends BaseGeneratorCommand {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a seed file.';

    /**
     * Model generator instance
     *
     * @var Way\Generators\Generators\SeedGenerator
     */
    protected $generator;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SeedGenerator $generator)
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
        $path = $this->getPath();
        $className = basename($path, '.php');
        $template = $this->option('template');

        $this->printResult($this->generator->make($path, $template), $path);

        $this->generator->updateDatabaseSeederRunMethod($className);
        $this->info('Updated ' . app_path() . '/database/seeds/DatabaseSeeder.php');


    }

    /**
     * Get the path to the file that should be generated
     *
     * @return string
     */
    protected function getPath()
    {
        return $this->option('path') . '/' . ucwords($this->argument('name')) . 'TableSeeder.php';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Name of the model to generate.'),
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
            array('path', null, InputOption::VALUE_OPTIONAL, 'Path to the models directory.', 'app/database/seeds'),
            array('template', null, InputOption::VALUE_OPTIONAL, 'Path to template.', __DIR__.'/../Generators/templates/seed.txt'),
        );
    }

}