<?php

namespace App\Models\Pages\Sections;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pages\Sections\Components\Component;
use App\Models\Traits\UpdatedAtTrait;
use App\Models\Pages\Page;

class Section extends Model
{
    use UpdatedAtTrait;

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
        'index',
        'template_path',
        'components_max',
        'type_id',
        'editable_contents'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type_id'           => 'integer',
        'components_max'    => 'integer',
        'editable_contents' => 'array'
    ];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
    ];

    /**
     * Get the type that owns the section.
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * The pages that belong to the section.
     */
    public function pages()
    {
        return $this->belongsToMany(Page::class)
            ->withPivot(["order"])
            ->orderBy('pivot_order',"ASC")
            ->withTimestamps();
    }

    /**
     * Trae las sections del component
     */
    public function components()
    {
        return $this->hasMany(Component::class)
            ->orderBy('order',"ASC");
    }


    public function isDeletable()
    {
        $total = 0;
        $total += $this->pages->count();
        $total += $this->components->count();
        return $total == 0;
    }
}
