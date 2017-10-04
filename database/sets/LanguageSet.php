<?php
use App\Console\Cltvo\SetSite\CltvoSet;
use Illuminate\Console\Command;

class LanguageSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "Idiomas";

    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return "App\Models\Language";
    }

    /**
     * valores a ser introducidos en la base
     */
    protected function CltvoGetItems(){

        $languages = [];
        $available_languages = Config::get('app.available_langs');

        foreach ($available_languages as $iso => $name) {
            $languages[] = [
                "iso6391"   => $iso,
                "label"     => $name
            ];
        }

        return $languages;
    }

}
