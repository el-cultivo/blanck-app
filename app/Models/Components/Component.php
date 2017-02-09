<?php

namespace App\Models\Components;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\TranslationTrait;
use App\Models\Traits\UniqueSlugTrait;
use App\Models\Traits\PhotoableTrait;

use App\Models\Sections\Section;

class Component extends Model
{
    use UniqueSlugTrait;
    use TranslationTrait;
    use PhotoableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'components';

    /**
     * The database table used by language pivot.
     *
     * @var string
     */
    protected $translation_table = 'component_language';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rules'
    ];

    protected  $translatable = [
        'slug',
        'label',
        'title',
        'content'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'slug',
        'label',
        'title',
        'content'
    ];

    public static $image_uses = [
        'thumbnail',
    ];

    public static $image_galleries = [ 
        'gallery'
    ];

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getSlugAttribute()
    {
        return $this->translation()->slug;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getLabelAttribute()
    {
        return $this->translation()->label;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getTitleAttribute()
    {
        return $this->translation()->label;
    }

    /**
     * Get the administrator flag for the user.
     *
     * @return bool
     */
    public function getContentAttribute()
    {
        return $this->translation()->label;
    }

    /**
     * Trae las sections del component
     */
    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }

    public function isDeletable()
    {
        $total = 0;
        $total += $this->sections->count();
        return $total == 0;
    }
}
