<?php

use Illuminate\Console\Command;

class PermissionSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "permissions";

    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return "App\Permission";
    }

    /**
     * valores a ser introducidos en la base
     */
    protected function CltvoGetItems(){
        return [
            [
                "slug"  => "admin_access",
                "label"  => "Acceso al admin"
            ],
            [
                "slug"  => "system_config",
                "label" => "Configuración del sistema"
            ],
            [
                "slug"  => "manage_users",
                "label"  => "Manejo de usuarios"
            ],
            [
                "slug"  => "manage_photos",
                "label" => "Manejo de imagenes"
            ],
            [
                "slug"  => "associate_photos",
                "label" => "asociar imagenes"
            ],


            [
                "slug"  => "manage_pages",
                "label" => "Manejo de páginas"
            ],

            [
                "slug"  => "manage_films",
                "label" => "Manejo de películas"
            ],

            [
                "slug"  => "manage_categories",
                "label" => "Manejo de categorías"
            ],
            [
                "slug"  => "associate_categories",
                "label" => "asociar categorías"
            ],

            [
                "slug"  => "manage_clicks",
                "label" => "Manejo de clics"
            ],

        ];
    }

}
