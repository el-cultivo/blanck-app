<?php

namespace App\Models;

use App;

use Auth;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'languages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label','iso6391'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    /**
     * Genera la lista de isos de los paises del sistema
     * @return array lsita de isos de los idiomas
     */
    public static function getLanguagesIso()
    {
        if (!session("languages_iso") || session("languages_iso")->count() == 0 ) {
            session(["languages_iso" => static::orderBy("id","ASC")->pluck('iso6391','id') ]);
        }

        return session("languages_iso")  ;
    }

    /**
     * Genera la lista de los nombres de los paises del sistema
     * @return array lsita de los nombres de los idiomas
     */
    public static function getLanguagesNames()
    {
        return static::orderBy("id","ASC")->pluck('label','id');
    }

    /**
     * Genera la lista de isos de los paises del sistema
     * @return array lsita de isos de los idiomas
     */
    public static function generateRouteFilter( $gluter = '|')
    {
        return static::getLanguagesIso()->implode($gluter);
    }

    /**
     * Genera la lista de los nombres de los paises del sistema
     * @return array lsita de los nombres de los idiomas
     */
    public static function getCurrentLanguage()
    {
        $currentLanguage = session('lang');

        if (!static::languageExist($currentLanguage)) {
            $currentLanguage = App::getLocale();
        }

        return  static::getLanguageByIso($currentLanguage);
    }

    public static function languageExist($iso)
    {
        return in_array($iso, static::getLanguagesIso()->toArray()  );
    }

    public function scopeLanguagesByIso($query, $iso)
    {
        return $query->where(["iso6391" => $iso]);
    }

    public static function getLanguageByIso($iso)
    {
        return static::languagesByIso($iso)->get()->first();
    }

    public function isCurrentLanguage()
    {
        return App::getLocale() == $this->iso6391;
    }

}
