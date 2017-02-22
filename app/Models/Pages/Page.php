<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\TranslationTrait;
use App\Models\Traits\UniqueTranslatableSlugTrait;
use App\Models\Traits\PublishableTrait;
use App\Models\Traits\UpdatedAtTrait;

use App\Models\Pages\Sections\Section;

class Page extends Model
{

    use TranslationTrait;
    use UniqueTranslatableSlugTrait;
    use PublishableTrait;
    use UpdatedAtTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
     * The database table used by language pivot.
     *
     * @var string
     */
    protected $translation_table = 'language_page';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'index',
        'order',
        'parent_id',

        'publish_id',
        'publish_at',

        'tblank',
    ];

    protected $translatable = [
        'label',
        'slug',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'publish_at'
    ];

    /**
     * Get the current language label.
     *
     * @return bool
     */
    public function getLabelAttribute()
    {
        return $this->translation()->label;
    }

    /**
     * Get the current language slug.
     *
     * @return bool
     */
    public function getSlugAttribute()
    {
        return $this->translation()->slug;
    }

    public function childs()
    {
        return $this->hasMany(static::class);
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    // start; Función para saber si una página es padre.

    public function isParent()
    {
        return is_null($this->parent);
    }

    // start; Función scope para obtener las páginas que no tienen padres.

    public function scopeParents($query)
    {
        return $query->doesntHave('parent');
    }

    /**
     * The sections that belong to the page.
     */
    public function sections()
    {
        return $this->belongsToMany(Section::class)
            ->withPivot(["order"])
            ->orderBy('pivot_order',"ASC")
            ->withTimestamps();
    }




    // start; Función scope para obtener las páginas que apareceran en el menú principal

    // public function scopeMenuMain($query)
    // {
    //     return $query->where([ 'header' => 1 ]);
    // }
    //
    // // start; Función scope para obtener las páginas que apareceran en el footer
    //
    // public function scopeMenuFooter($query)
    // {
    //     return $query->where([ 'footer' => 1 ]);
    // }
    //
    // // start; Función para obtener la página que funcionará como Home
    //
    // public function scopeHome($query, $home = true)
    // {
    //     return $query->where(['home' => $home]);
    // }

}
