<?php

namespace App\Models\Pages\Sections;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\PhotoableTrait;
use App\Models\Components\Component;

class Section extends Model
{
    use PhotoableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sections';

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
        'index'
    ];

    public static $image_uses = [
        'thumbnail',
    ];

    public static $image_galleries = [
        'gallery'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'order',
        'label',
        'description',
        'view'
    ];

    /**
     * Trae las sections del component
     */
    public function components()
    {
        return $this->belongsToMany(Component::class);
    }

    /**
     * Trae el Section Type del Section
     */
    public function sectiontype()
    {
        return $this->belongsTo(Sectiontype::class);
    }

    public function isDeletable()
    {
        $total = 0;
        $total += $this->components->count();
        return $total == 0;
    }
}
