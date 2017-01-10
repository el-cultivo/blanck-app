<?php

namespace App\Models\Films;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\TranslationTrait;
use App\Models\Traits\UniqueSlugTrait;


class Category extends Model
{
    use UniqueSlugTrait;
    use TranslationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The database table used by language pivot.
     *
     * @var string
     */
    protected $translation_table = 'category_language';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ["created_at","updated_at"];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    protected  $translatable = [
        'slug',
        'label',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'slug',
        'label',
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

    public function films()
    {
        return $this->hasMany(Film::class);
    }

    public function isDeletable()
    {
        $total = 0;
        $total += $this->films->count();
        return $total == 0;
    }
}
