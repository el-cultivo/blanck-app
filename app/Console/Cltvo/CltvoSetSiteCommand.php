<?php

namespace App\Console\Cltvo;

use Illuminate\Console\Command;

class CltvoSetSiteCommand extends Command
{
    /**
     * resiter set classes
     * @var array
     */
    protected $set_classes = [
        'PermissionSet',
        'RoleSet',
        'AssociatePermissionRoleSet',
        'FirstUserSet',
        'AdminsUserSet',
        'LanguageSet',
        'PhotoSet',
        'PublishSet',

        'PageSectionTypeSet',
        'PageSet',
		'PageSectionSet',
		'AssociatePageSectionPageSet',
        'CopySet',
        'ShapeSet'
    ];

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        shell_exec("composer dump-autoload");

        if ($this->option("migrate") ) {
            $this->call("migrate");
        }

        if ($this->option("migrate-refresh") || $this->option("clean")) {
            $this->call("migrate:refresh");
        }


        foreach ($this->set_classes as $class) {

            $seter = new $class;
            $seter->CltvoPlow($this);
            $this->line( '<info>'.$seter->CltvoGetLabel().':</info>'." set successfully." );
        }

        if ($this->option("seed") || $this->option("clean")) {
            $this->call("db:seed");
        }
    }

}
