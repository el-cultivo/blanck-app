<?php

namespace App\Models;

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
        "updated_at",
		"id"
    ];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
		'is_current',
		'translate_url',
    ];

    /**
     * Genera la lista de isos de los paises del sistema
     * @return array lsita de isos de los idiomas
     */
    public static function getLanguagesIso()
    {
        if (!session("languages_iso") || (session("languages_iso")->count() != count(config('app.available_langs'))) ) {
            session(["languages_iso" => static::available()->orderBy("id","ASC")->pluck('iso6391','id') ]);
        }

        return session("languages_iso")  ;
    }

	public function scopeAvailable($query)
	{
		return $query->whereIn('iso6391', array_keys(config('app.available_langs')) );
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

    // /**
    //  * Genera la lista de los nombres de los paises del sistema
    //  * @return array lsita de los nombres de los idiomas
    //  */
    // public static function getCurrentLanguage()
    // {
    //     $currentLanguage = cltvoCurrentLanguageIso();
	//
    //     if (!static::languageExist($currentLanguage)) {
    //         $currentLanguage = config("app.locale");
    //     }
	//
    //     return  static::getLanguageByIso($currentLanguage);
    // }

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

    public function getIsCurrentAttribute()
    {
        return cltvoCurrentLanguageIso() == $this->iso6391;
    }

	public function getTranslateUrlAttribute()
	{
		return	route('client::language',$this->iso6391);
	}

}
