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
                "slug"  => "photos_view",
                "label" => "Ver imagenes"
            ],
            [
                "slug"  => "routes_view",
                "label" => "Ver rutas"
            ],

            [
                "slug"  => "manage_pages",
                "label" => "Manejo de páginas"
            ],

            [
                "slug"  => "manage_pages_contents",
                "label" => "Manejo del contenido de las páginas"
            ],

        ];
    }

}
