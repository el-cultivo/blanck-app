<?php
use App\Console\Cltvo\SetSite\CltvoSet;
use Illuminate\Console\Command;

use App\Models\Settings\SeoBooster;
use App\Models\Pages\Page;

use App\Models\Language;
use App\Models\Publish;
use App\Models\Photo;

class PageSet extends CltvoSet
{
    /**
     *  Etiqueta a desplegarse para informar al final
     */
    protected $label = 'pages';

    /**
     *  Etiqueta del display del modelo
     * @var string
     */
    protected $model_label = 'index';

    /**
     *  Lenguages del sistema
     */
    protected $languages = [];

    /**
     *  Status publicado
     */
    protected $publish = [];

    /**
     *  Constructor
     */
    function __construct()
    {
        $this->languages = Language::get();
        $this->publish = Publish::getPublish();
    }

    /**
     *  Nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass()
    {
        return 'App\Models\Pages\Page';
    }

    /**
     *  Valores a ser introducidos en la base de datos
     */
    protected function CltvoGetItems()
    {
        return [
            'home' => [
                'index'         => 'main',
                'order'         => null,
                'parent_id'     => null,
                'tblank'        => false,
                'publish_id'    => $this->publish->id,
                'publish_at'    => date('Y-m-d'),
                'main'          => true,
                'translations'  => [
                    'en'        => [
                        'label'  => 'Main'
                    ],
                    'es'        => [
                        'label'  => 'Principal'
                    ]
                ]
            ]
        ];
    }

    /**
     *  Método de introducción de valores
     *  @param array   $page_args   Argumentos que definiran el sembrado
     *  @param Command $command     Comando actual
     */
    protected function CltvoSower(array $page_args, Command $command)
    {
        $page = Page::where(['index' => $page_args['index']])->first();

        if(!$page)
        {
            if ($this->createPage($page_args))
            {
                $command->line('<info>' . $page_args[$this->model_label] . ':</info>' . ' successfully set.');
            }
            else
            {
                $command->error('<error>' . $page_args[$this->model_label] . ':</error>' . ' not successfully set.');
            }
        }
        else
        {
            $command->line('<comment>' . $page_args[$this->model_label] . ':</comment>' . ' previously set.');
        }

    }

    /**
     *  Método para crear página
     *  @param array   $page_args   Argumentos para crear la página
     */
    protected function createPage(array $page_args)
    {
        // Quitar item de translations
        $translations = $page_args['translations'];
        unset($page_args['translations']);

        // Crear página
        $page = Page::create($page_args);

        if(!$page)
        {
            return false;
        }

        // Si es página principal...
        if (isset($page_args['main']) && $page_args['main'])
        {
            if (!Page::getMainPage())
            {
                $page->main = $page_args['main'];
                if(!$page->save())
                {
                    return false;
                }
            }
        }

        // Translations de páginas
        foreach ($this->languages as $language)
        {
            $translation = [
                'slug'  => Page::generateUniqueSlug($translations[$language->iso6391]['label']),
                'label' => $translations[$language->iso6391]['label']
            ];

            $page->updateTranslation($language, $translation);
        }

        // Items de Seo Boosters
        $seo_boosters = [
            'route_name'    => 'client::pages.show',
            'parameters'    => $page->slug
        ];

        // Crear Seo Booster
        $seo_booster = SeoBooster::create($seo_boosters);

        if(!$seo_booster)
        {
            return false;
        }

        // Translations de Seo Booster
        foreach ($this->languages as $language)
        {
            $translation = [
                'title'         => $translations[$language->iso6391]['label'],
                'description'   => 'Description' // Pendiente
            ];

            $seo_booster->updateTranslation($language, $translation);
        }

        // Asociar Photos al Seo Booster
        $photos = Photo::get();

        if(!$photos->isEmpty())
        {
            $seo_booster->associateImage($photos->random(1), ['use' => 'thumbnail']);
        }

        return true;
    }
}
