<?php

namespace App\Console\Cltvo;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\ConfirmableTrait;

class CltvoSetSiteCommand extends Command
{
	use ConfirmableTrait;

	/**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'cltvo:set';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cltvo:set {--s|seed : Seed the database with records } {--m|migrate : Run database migrations } {--r|migrate-refresh : Rollback all database migrations } {--c|clean : seed and migrate-refresh}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Preconfiguration of the App';


	/**
     * The Composer instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct( Composer $composer)
    {
        parent::__construct();

		$this->composer = $composer;
    }

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{

		if (! $this->confirmToProceed()) {
			return;
		}

		$this->composer->dumpAutoloads();

        if ($this->option("migrate") ) {
            $this->call("migrate");
        }

        if ($this->option("migrate-refresh") || $this->option("clean")) {
            $this->call("migrate:refresh");
        }

		Model::unguarded(function () {
			$this->getSeeder()->run();
		});

        if ($this->option("seed") || $this->option("clean")) {
            $this->call("db:seed");
        }

	}

	/**
     * Get a seeder instance from the container.
     *
     * @return \Illuminate\Database\Seeder
     */
    protected function getSeeder()
    {
        return new \DatabaseSeter($this);
    }

}
