<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\Setting\MailsTrait;
use App\Models\Traits\Setting\SocialNetworksTrait;

class Setting extends Model
{
    use MailsTrait;
	use SocialNetworksTrait;

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
		'key'	=> 'string'
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

}
