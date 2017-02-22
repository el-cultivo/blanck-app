<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\TranslationTrait;
use App\Models\Traits\UniqueSlugTrait;
use App\Models\Traits\PhotoableTrait;
use App\Models\Traits\PublishableTrait;

use Carbon\Carbon;

class Page extends Model
{

    use TranslationTrait;
    use UniqueSlugTrait;
    use PhotoableTrait;
    use PublishableTrait;

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
        'slug',
        'order',
        'tblank',
    ];

    protected $translatable = [
        'name',
        'slug',
        'content',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'publish_at'
    ];

    public function childs()
    {
        return $this->hasMany(static::class);
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'page_id');
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

    // start; Función scope para obtener las páginas que apareceran en el menú principal

    public function scopeMenuMain($query)
    {
        return $query->where([ 'header' => 1 ]);
    }

    // start; Función scope para obtener las páginas que apareceran en el footer

    public function scopeMenuFooter($query)
    {
        return $query->where([ 'footer' => 1 ]);
    }

    // start; Función para obtener la página que funcionará como Home

    public function scopeHome($query, $home = true)
    {
        return $query->where(['home' => $home]);
    }

    // start; Funciones para obtener la última edición de una página en español.

    public function lastEdit()
    {
        $created = $this->updated_at;
        $now = Carbon::now();
        return $this->updated_at->diff($now)->days < 1 ? 'Hoy' : $this->updated_at->diffForHumans($now);
    }

    public function getEditDateForHumansAttribute($full = false)
    {
        $now = Carbon::now();
        $ago = $this->updated_at;
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = [
            'y' => 'años',
            'm' => 'mes',
            'w' => 'semana',
            'd' => 'dia',
            'h' => 'hora',
            'i' => 'minuto',
            's' => 'segundo',
        ];

        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);

        return $string ? 'Hace ' .implode(', ', $string) : 'just now';

    }

    // end; Funciones para obtener la última edición de una página en español.

}
