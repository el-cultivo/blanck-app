<?php namespace App\Models\Traits\Setting;

trait RouteKeyTrait {

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
        return  str_slug( static::cleanRouteName($route_name)."_".$key."_".static::VARIABLE_SUFFIX,"_");
    }

    public static function cleanRouteName($route_name)
    {
        $route_name_parts = explode("::", $route_name );
        return  str_slug( str_replace([":","."], "_", $route_name_parts[1] ),"_");
    }

    public function getCleanRouteNameAttribute()
    {
        return static::cleanRouteName($this->route_name);
    }

    public function getVariableNameAttribute()
    {
        return static::getVariableName($this->route_name,$this->key);
    }

}
