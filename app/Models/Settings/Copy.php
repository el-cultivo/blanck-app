<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\TranslationTrait;
use App\Models\Traits\PhotoableTrait;
use App\Models\Traits\UpdatedAtTrait;

class Copy extends Model
{
    use TranslationTrait;
    use PhotoableTrait;
    use UpdatedAtTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'copies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'route_name',
    ];

    /**
     * The database table used by language pivot.
     *
     * @var string
     */
    protected $translation_table = 'copy_language';

    protected $translatable = [
        'value',
    ];

    public static $image_uses = [
        'thumbnail',
        'gallery'
    ];

    public static $image_galleries = [
        'gallery'
    ];

    /**
     * Get the current language title.
     *
     * @return bool
     */
    public function getValueAttribute()
    {
        return $this->translation()->value;
    }

    /**
    * Scope a query to get element by key
    *
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeName($query, $route_name, $key)
    {
        return $query->byRoute($route_name)->byKey($key);
    }

    /**
    * Scope a query to get element by key
    *
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeByRoute($query, $route_name)
    {
        return $query->where([
            'route_name'           => $route_name,
        ]);
    }

    /**
    * Scope a query to get element by key
    *
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeByKey($query, $key)
    {
        return $query->where([
            'key'           => $key,
        ]);
    }


    public static function getVariableName($route_name, $key)
    {
        return  str_slug( static::cleanRouteName($route_name)."_".$key."_copy","_");
    }


    public function getCleanRouteNameAttribute()
    {
        return static::cleanRouteName($this->route_name);
    }

    public static function cleanRouteName($route_name)
    {
        $route_name_parts = explode("::", $route_name );
        return  str_slug( str_replace([":","."], "_", $route_name_parts[1] ),"_");
    }

    public function getVariableNameAttribute()
    {
        return static::getVariableName($this->route_name,$this->key);
    }
}
