<?php

namespace App\Models\Pages\Sections\Components;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\TranslationTrait;
use App\Models\Traits\PhotoableTrait;

use App\Models\Sections\Section;

class Component extends Model
{
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
        'order',
        'section_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order'         => 'integer',
        'section_id'    => 'integer',
    ];

    protected  $translatable = [
        'title',
        'subtitle',
        'excerpt',
        'content',
        'iframe',
        'link'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'title',
        'subtitle',
        'excerpt',
        'content',
        'iframe',
        'link'
    ];

    public static $image_uses = [
        'thumbnail',
        'gallery'
    ];

    public static $image_galleries = [
        'gallery'
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
     * Get the current language subtitle.
     *
     * @return bool
     */
    public function getSubtitleAttribute()
    {
        return $this->translation()->subtitle;
    }

    /**
     * Get the current language excerpt.
     *
     * @return bool
     */
    public function getExcerptAttribute()
    {
        return $this->translation()->excerpt;
    }

    /**
     * Get the current language content.
     *
     * @return bool
     */
    public function getContentAttribute()
    {
        return $this->translation()->content;
    }

    /**
     * Get the current language iframe.
     *
     * @return bool
     */
    public function getIframeAttribute()
    {
        return $this->translation()->iframe;
    }

    /**
     * Get the current language link.
     *
     * @return bool
     */
    public function getLinkAttribute()
    {
        return $this->translation()->link;
    }

    /**
     * Trae las sections del component
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

}
