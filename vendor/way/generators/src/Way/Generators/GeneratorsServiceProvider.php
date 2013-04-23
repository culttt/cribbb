<?php namespace Way\Generators;

use Way\Generators\Commands;
use Way\Generators\Generators;
use Way\Generators\Cache;
use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerModelGenerator();
		$this->registerControllerGenerator();
		$this->registerResourceGenerator();
		$this->registerScaffoldGenerator();
		$this->registerViewGenerator();
		$this->registerMigrationGenerator();
		$this->registerSeedGenerator();
		$this->registerFormDumper();

		$this->commands(
			'generate.model',
			'generate.controller',
			'generate.scaffold',
			'generate.resource',
			'generate.view',
			'generate.migration',
			'generate.seed',
			'generate.form'
		);
	}

	/**
	 * Register generate:model
	 *
	 * @return Commands\ModelGeneratorCommand
	 */
	protected function registerModelGenerator()
	{
		$this->app['generate.model'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new Generators\ModelGenerator($app['files'], $cache);

			return new Commands\ModelGeneratorCommand($generator);
		});
	}

	/**
	 * Register generate:controller
	 *
	 * @return Commands\ControllerGeneratorCommand
	 */
	protected function registerControllerGenerator()
	{
		$this->app['generate.controller'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new Generators\ControllerGenerator($app['files'], $cache);

			return new Commands\ControllerGeneratorCommand($generator);
		});
	}

	/**
	 * Register generate:view
	 *
	 * @return Commands\ViewGeneratorCommand
	 */
	protected function registerViewGenerator()
	{
		$this->app['generate.view'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new Generators\ViewGenerator($app['files'], $cache);

			return new Commands\ViewGeneratorCommand($generator);
		});
	}

	/**
	 * Register generate:scaffold
	 *
	 * @return Commands\ScaffoldGeneratorCommand
	 */
	protected function registerScaffoldGenerator()
	{
		$this->app['generate.scaffold'] = $this->app->share(function($app)
		{
			$generator = new Generators\ResourceGenerator($app['files']);
			$cache = new Cache($app['files']);

			return new Commands\ScaffoldGeneratorCommand($generator, $cache);
		});
	}

	/**
	 * Register generate:scaffold
	 *
	 * @return Commands\ScaffoldGeneratorCommand
	 */
	protected function registerResourceGenerator()
	{
		$this->app['generate.resource'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new Generators\ResourceGenerator($app['files'], $cache);

			return new Commands\ResourceGeneratorCommand($generator, $cache);
		});
	}

	/**
	 * Register generate:migration
	 *
	 * @return Commands\MigrationGeneratorCommand
	 */
	protected function registerMigrationGenerator()
	{
		$this->app['generate.migration'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new Generators\MigrationGenerator($app['files'], $cache);

			return new Commands\MigrationGeneratorCommand($generator);
		});
	}

	/**
	 * Register generate:migration
	 *
	 * @return Commands\MigrationGeneratorCommand
	 */
	protected function registerSeedGenerator()
	{
		$this->app['generate.seed'] = $this->app->share(function($app)
		{
			$cache = new Cache($app['files']);
			$generator = new Generators\SeedGenerator($app['files'], $cache);

			return new Commands\SeedGeneratorCommand($generator);
		});
	}

	/**
	 * Register generate:migration
	 *
	 * @return Commands\MigrationGeneratorCommand
	 */
	protected function registerFormDumper()
	{
		$this->app['generate.form'] = $this->app->share(function($app)
		{
			$gen = new Generators\FormDumperGenerator($app['files'], new \Mustache_Engine);

			return new Commands\FormDumperCommand($gen);
		});
	}

}