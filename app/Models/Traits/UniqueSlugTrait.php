<?php

namespace App\Models\Traits;

trait UniqueSlugTrait
{

	public function getColSlugName()
    {
        return "slug";
    }

    public function getColLabelName()
    {
        return "label";
    }

    /**
     * genera un nombre de usuario unico a partir del nombre y apellido
     * @param  string $name     nombre
     * @return string           slug
     */
    public static function generateUniqueSlug($name)
    {
        $slug = str_slug(trim($name));
        $not_unique_slug = true;
        $gluter = "-";

        while ($not_unique_slug) {
            if (!static::slugExist($slug)) {
                $not_unique_slug = false;
            }else {
                $slug .= $gluter.rand(0,9);
            }
            $gluter = "";
        }

        return $slug;
    }



    public static function slugExist($slug)
    {
        return static::getModelBySlug($slug)->count() > 0;
    }

    public function scopeGetModelBySlug($query, $slug)
    {
        return $query->where($this->getColSlugName(), $slug);
    }



    public static function getObjectBySlug($slug)
    {
        $models = static::getModelBySlug($slug)->get();
        return $models->count() > 0 ? $models->first() : null;
    }

    public function updateUniqueSlug( $new_name )
    {
        if (trim(strtolower($new_name))  == trim(strtolower($this->{$this->getColLabelName()})) ) {
            return $this->{$this->getColSlugName()};
        }

        return static::generateUniqueSlug($new_name);
    }
}
