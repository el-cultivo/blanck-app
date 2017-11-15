<?php 

namespace App\Models\Traits;

use App\Models\Seo\Seo;

trait SeoableTrait
{
    /**
     * Nombre de la ruta pública del modelo.
     *
     * @return bool
     */
    public function getPublicRouteName()
    {
        return '';
    }

    /**
     * Parametros y valores que recibe la ruta pública.
     *
     * @return bool
     */
    public function getPublicParameters()
    {
        return [];
    }

    /**
     * Método para buscar el modelo en la BD y verificar si existe cuando se crea el SEO.
     *
     * @return Model
     */
    public function scopeSeoQuery($query, $value)
    {
        return $query->getModelBySlug($value);
    }

    /**
     * Trae el SEO correspondiente al modelo.
     *
     * @return bool
     */
    public function getSeo()
    {
        return Seo::queryWithParameters($this->getPublicRouteName(), $this->getPublicParameters())->first();
    }

    /**
     * Obtiene el primer SEO del modelo o crea uno si es necesario.
     *
     * @return bool
     */
    public function getOrCreateSeo()
    {
        if ($this->hasSeo()) {
            return $this->getSeo();
        }

        return Seo::generate($this->getPublicRouteName(), $this->getPublicParameters());
    }

    /**
     * Obtiene el primer SEO del modelo o crea uno si es necesario.
     *
     * @return bool
     */
    public function hasSeo()
    {
        return !!$this->getSeo();
    }
}
