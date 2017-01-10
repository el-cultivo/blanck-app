<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    public $primaryKey  = 'key';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key','value'
    ];

    protected $casts = [
        'value' => 'array',
    ];

    protected $attributes = [
        'value' => '',
    ];

    /**
    * Scope a query to get element by key
    *
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeKey($query, $key)
    {
        return $query->where('key', $key);
    }

    public static function getSetting($key )
    {
        //   $key = $slug . $sufix;
        $setting = static::key($key)->get()->first();

        if (!$setting) {
            $setting = self::create([ 'key' => $key] );
        }

        return $setting;
    }

    /**
    * Get the Social Networks Link
    *
    * @return array[] with urls,
    */
    public static function getSocialNetworks()
    {
        return self::getSetting('social')->value;
    }

    public static function getSpecificSocialNetwork( $sn_name )
    {
        return array_get(self::getSocialNetworks(), $sn_name);
    }

    /**
    * Get the Mail values
    *
    * @return array[] with urls,
    */
    public static function getMail()
    {
        return self::getSetting('mail')->value;
    }

    public static function getEmail($key):string
    {
        $mail = self::getMail();
        if (!$mail || !array_has($mail,$key) ) {
            return env('SEND_MAIL_AS');
        }
        return $mail[$key];
    }

    public static function getEmailCopy($key, $iso = null):string
    {
        $iso = is_null($iso) ? session('lang') : $iso;

        $key = $key.'_copy';

        $mail = self::getMail();
        if (!$mail || !array_has($mail, $key.'.'.$iso) ) {
            return '';
        }
        return $mail[$key][$iso];
    }

    public static function getEmailGreeting($iso = null):string
    {
        $iso = is_null($iso) ? session('lang') : $iso;

        $mail = self::getMail();
        if (!$mail || !array_has($mail, 'mail_greeting.'.$iso) ) {
            return '';
        }
        return $mail[$key][$iso];
    }

    public static function getEmailFarewell($iso = null):string
    {
        $iso = is_null($iso) ? session('lang') : $iso;

        $mail = self::getMail();
        if (!$mail || !array_has($mail, 'mail_farewell.'.$iso) ) {
            return '';
        }
        return $mail[$key][$iso];
    }

}
