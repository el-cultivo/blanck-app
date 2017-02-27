<?php

use Illuminate\Console\Command;

class PageSectionTypeSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "Tipos de secciones de páginas";

    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return "App\Models\Pages\Sections\Type";
    }

    /**
     * valores a ser introducidos en la base
     */
    protected function CltvoGetItems(){

        return [
            [
                "label"             => "Especial",
                "description"       => "Seccion que requiere informacion de modelos diferentes a los componenetes",
                "admin_view_path"   => "protected",
                "protected"         =>  true,
                "unlimited"         =>  false,
            ],
            [
                "label"             => "Sensilla",
                "description"       => "Seccion que requiere informacion un unico componente",
                "admin_view_path"   => "single",
                "protected"         =>  false,
                "unlimited"         =>  false,
            ],
            [
                "label"             => "Miltiple fija",
                "description"       => "Seccion que requiere informacion de una cantidad exacta de componentes",
                "admin_view_path"   => "multipe-limited",
                "protected"         =>  false,
                "unlimited"         =>  false,
            ],
            [
                "label"             => "Miltiple ilimitada",
                "description"       => "Seccion que requiere informacion de una cantidad ilimitada de componentes",
                "admin_view_path"   => "multipe-unlimited",
                "protected"         =>  false,
                "unlimited"         =>  true,
            ],
        ];
    }

}
