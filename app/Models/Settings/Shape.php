<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\PhotoableTrait;
use App\Models\Traits\UpdatedAtTrait;
use App\Models\Traits\Setting\RouteKeyTrait;

class Shape extends Model
{
    use PhotoableTrait;
    use UpdatedAtTrait;
    use RouteKeyTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shapes';

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
     * The suffix of the varible name
     * @var string
     */
    const VARIABLE_SUFFIX = "image";

    public static $image_uses = [
        'thumbnail',
    ];

    public static $image_galleries = [
    ];
}
