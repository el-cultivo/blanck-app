<?php

namespace App\Console\Cltvo;

use Illuminate\Support\Composer;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;

use Symfony\Component\Console\Input\InputOption;

class CltvoSetMakeCommand extends GeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Cltvo set class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'CltvoSet';

    /**
     * The Composer instance.
     *
     * @var \Illuminate\Support\Composer
     */
    protected $composer;


    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Support\Composer  $composer
     * @return void
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        parent::__construct($files);

        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        parent::fire();

        $this->composer->dumpAutoloads();
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option("setup")) {
            return __DIR__."/Stubs/cltvo-set.setup.stub";
        }
        return __DIR__."/Stubs/cltvo-set.stub";
    }

    // /**
    //  * Get the default namespace for the class.
    //  *
    //  * @param  string  $rootNamespace
    //  * @return string
    //  */
    // protected function getDefaultNamespace($rootNamespace)
    // {
    //     return $rootNamespace.'\Console\Cltvo\Sets';
    // }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return $this->laravel->databasePath().'/sets/'.$name.'.php';
    }

    /**
     * Parse the name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function parseName($name)
    {
        return $name;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['setup', 's', InputOption::VALUE_NONE, 'CltvoSower method to overwrite'],
        ];
    }

}
