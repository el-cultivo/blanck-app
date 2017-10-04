<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\TranslationTrait;
use App\Models\Traits\UpdatedAtTrait;
use App\Models\Traits\Setting\RouteKeyTrait;

class Copy extends Model
{
    use TranslationTrait;
    use UpdatedAtTrait;
    use RouteKeyTrait;

    /**
     * The suffix of the varible name
     * @var string
     */
    const VARIABLE_SUFFIX = "copy";

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

    /**
     * Get the current language title.
     *
     * @return bool
     */
    public function getValueAttribute()
    {
        return $this->translation()->value;
    }

}
