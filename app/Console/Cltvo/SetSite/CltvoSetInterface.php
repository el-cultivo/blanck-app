<?php
namespace App\Console\Cltvo\SetSite;

use Illuminate\Console\Command;

/**
 *
 */
interface CltvoSetInterface
{

	/**
     * display name of this set to show in the endo of the set
     */
	public function CltvoGetLabel();

	/**
	 * corre el cicolara salvar cada uno de los valores en la base
	 */
	public function CltvoPlow(Command $comand);

}
