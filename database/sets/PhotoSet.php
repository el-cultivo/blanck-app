<?php
use App\Console\Cltvo\SetSite\CltvoSetInterface;
use Illuminate\Console\Command;

class PhotoSet implements CltvoSetInterface
{

    /**
     * display name of this set to show in the endo of the set
     */
    public function CltvoGetLabel()
    {
        return "Imagenes";
    }
    /**
     * corre el cicolara salvar cada uno de los valores en la base
     */
    public function CltvoPlow(Command $comand){

        $seeder_folder = storage_path ("app/cltvo/image_seeder") ;

        if (!File::exists($seeder_folder)) {
            File::makeDirectory($seeder_folder,0777,true);
        }

        $storage_link = public_path("storage");

        if (File::exists($storage_link)) {
            $comand->comment("The [public/storage] directory previously set.");
            return;
        }

        $comand->call("storage:link") ;
    }

}
