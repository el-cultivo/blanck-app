<?php
namespace App\Console\Cltvo\SetSite;

use App\Console\Cltvo\SetSite\CltvoSetInterface as Seter;
use Illuminate\Console\Command;

abstract class CltvoSeter
{

	protected $command;

	function __construct(Command $command)
	{
		$this->command = $command;
	}
    /**
     * run set in db
     */
    abstract public function run() ;

    /**
     * create and instance and run plow
     */
    protected function call($class){
		$this->plow( new $class );
    }

	/**
     * corre el cicolara salvar cada uno de los valores en la base
     */
    protected function plow(Seter $seter){
		$seter->CltvoPlow($this->command);
		$this->command->line( '<info>'.$seter->CltvoGetLabel().':</info>'." set successfully." );
    }

}
