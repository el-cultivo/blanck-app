<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\TranslationTrait;
use App\Models\Traits\PhotoableTrait;

class SeoBooster extends Model
{
    use TranslationTrait;
    use PhotoableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seo_booster';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_name',
        'parameters'
    ];

    /**
     * The database table used by language pivot.
     *
     * @var string
     */
    protected $translation_table = 'language_seo_booster';

    /**
     * The attributes that are translatables
     *
     * @var array
     */
    protected $translatable = [
        'title',
        'description'
    ];

    /**
     * The uses for Seo Booster Photo
     *
     * @var array
     */
    public static $image_uses = [
        'thumbnail'
    ];

    /**
     * Get the current language title.
     *
     * @return bool
     */
    public function getTitleAttribute()
    {
        return $this->translation()->title;
    }

    /**
     * Get the current language description.
     *
     * @return bool
     */
    public function getDescriptionAttribute()
    {
        return $this->translation()->description;
    }
}