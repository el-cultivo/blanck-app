<?php
use App\Console\Cltvo\SetSite\CltvoSet;
use Illuminate\Console\Command;

class PublishSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "Status de publicacion";

    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return "App\Models\Publish";
    }

    /**
     * valores a ser introducidos en la base
     */
    protected function CltvoGetItems(){
        return [
            [
                "label"         => "Publicado",
                "slug"          => "publicado",
                "is_publish"    => true,
            ],
            [
                "label"         => "Borrador",
                "slug"          => "borrador",
                "is_publish"    => false,
            ],
        ];
    }

}
