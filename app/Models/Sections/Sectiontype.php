<?php

namespace App\Models\Sections;

use Illuminate\Database\Eloquent\Model;

class Sectiontype extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sectiontypes';

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
        'label',
        'description',
        'view'
    ];

    /**
     * Trae los paises  del grupo
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }


    public function isDeletable()
    {
        return !boolval($this->sections->count());
    }
}
