<?php

namespace App\Models\Seo;

use Exception;
use Illuminate\Routing\Route;
use App\Models\Settings\Setting;
use App\Models\Traits\PhotoableTrait;
use App\Models\Traits\TranslationTrait;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route as RouteFacade;

class Seo extends Model
{
    use TranslationTrait;
    use PhotoableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seo';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $translation_table = 'language_seo';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'route_name',
        'parameters'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = ['route_name', 'parameters'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $casts = ['route_name' => 'string', 'parameters' => 'array'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $translatable = [
        'title',
        'description'
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $appends = [
        'title',
        'description',
        'uri',
        'thumbnail_image',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public static $binds = [
        // variable  => class name
        'public_page' => 'App\Models\Pages\Page',
        'public_child_page' => 'App\Models\Pages\Page',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public static $image_uses = [
        'thumbnail',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    public static $image_galleries = [];

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getTitleAttribute()
    {
        return $this->translation()->title;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getDescriptionAttribute()
    {
        return $this->translation()->description;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getUriAttribute()
    {
        return route($this->route_name, $this->parameters);
    }

    /**
     * Get edit structure url
     *
     * @return bool
     */
    public function getEditUrlAttribute()
    {
        return route("admin::seo.edit",$this->id);
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function scopeRoute($query, $route)
    {
        return $query->where('route_name', $route);
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function scopeParameters($query, $parameterName, $parameterValue)
    {
        return $query->where('parameters->' . $parameterName, $parameterValue);
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public static function getForCurrentRoute()
    {
        $route = static::getCurrentRoute();
        return static::getForRoute($route);
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public static function getCurrentRoute()
    {
        return RouteFacade::current();
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public static function getForRoute(Route $route)
    {
        foreach (array_reverse($route->parameters()) as $parameter) {

            if (is_object($parameter) && method_exists($parameter, 'getSeo')) {
                $seo = $parameter->getSeo();

                if (!is_null($seo)) {
                    return $seo;
                }
            }

        }

        return static::route($route->getName())->first() ?: static::getDefault();
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public static function getOrCreate($route_name, $parameters)
    {
        $seo = static::queryWithParameters($route_name, $parameters)->first();

        if (!is_null($seo)) {
            return $seo;
        }

        return static::generate($route_name, $parameters);
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    protected static function generate($route_name, $parameters = [])
    {
        $router = resolve('Illuminate\Contracts\Routing\Registrar');

        if (!$router->getRoutes()->hasNamedRoute($route_name)) {
            throw new Exception('Route is not registered.');
        }

        $parameterNames = $router->getRoutes()->getByName($route_name)->parameterNames();

        foreach ($parameterNames as $type) {

            if (!array_key_exists($type, $parameters)) {
                throw new Exception('Route do not receive ' . $type . ' as parameter.');
            }

            $binds = Seo::$binds;

            if (!array_key_exists($type, $binds)) {
                throw new Exception('Bind ' . $type . ' is not registered in Seo model.');
            }

            $class = $binds[$type];
            $seoable = $class::seoQuery($parameters[$type])->first();

            if (!$seoable) {
                throw new Exception('Model of type ' . $class . ' not found.');
            }
        }

        $data = [
            'route_name' => $route_name,
            'parameters' => $parameters
        ];

        return Seo::create($data);
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public static function queryWithParameters($name, $parameters)
    {
        // dd(array_keys($parameters), $parameters);
        return static::queryWithParameterNames($name, array_keys($parameters), $parameters);
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public static function queryWithParameterNames($name, $parameterNames = [], $parameters = [])
    {
        $query = static::route($name);

        foreach ($parameterNames as $parameterName) {
            if (array_key_exists($parameterName, $parameters)) {
                $query->parameters($parameterName, $parameters[$parameterName]);
            }
        }

        return $query->get();
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public static function getDefault($title = null, $description = null, $thumbnail = null)
    {
        return (object) [
            'title' => static::defaultTitle($title),
            'description' => static::defaultDescription($description),
            'thumbnail_image' => static::defaultThumbnail($thumbnail),
            'uri' => Request::url()
        ];
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public static function defaultTitle($title)
    {
        return !is_null($title) ? $title : config('app.name');
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public static function defaultDescription($description)
    {
        if (is_null($description)) {
            return '';
        }

        $iso = session('lang') ?: config('app.locale');

        if (method_exists(Setting::class, 'getDescription')) {
            $setting = Setting::getDescription();
            return $setting['description'][$iso] ?: '';
        }

        return '';
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public static function defaultThumbnail($url)
    {
        $thumbnail = (object) [
            'url' => asset('images/logo.png'),
            'thumbnail_url' => asset('images/logo.png'),
            'title' => '',
            'alt' => '',
            'description' => '',
        ];

        if (!is_null($url)) {
            $thumbnail->url = $url;
        }

        return $thumbnail;
    }

    /**
     * Helpers methods for Routing.
     * $route->getName()
     * $route->getPrefix()
     * $route->getUri()
     * $route->getMethods()
     * $route->parameters()
     * $route->getParameter()
     * $route->hasParameters()
     * $route->hasParameter()
     * $route->getController()
     * $route->parameterNames()
     *
     * @return dd()
     */
    public static function routeHelpers(Route $route, $method)
    {
        dd($route->$method());
    }

    // public function getIsosAttribute()
    // {
    //     $isos = [];
    //
    //     foreach ($this->languages as $item) {
    //         $isos[$item->iso6391] = $item;
    //     }
    //
    //     return $isos;
    // }

}
