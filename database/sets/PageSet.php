<?php

use Illuminate\Console\Command;

use App\Models\Pages\Page;
use App\Publish;
use App\Language;


class PageSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "pages";

    /**
     * etiqueta del display del modelo
     * @var string
     */
    protected $model_label =  "index";


    /**
     * lenguages del sistema
     */
    protected $languages =  [];

    /**
     *  status publicado
     */
    protected $publish =  [];

    function __construct() {
        $this->languages  = Language::get();
        $this->publish = Publish::getPublish();
    }
    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return "App\Models\Pages\Page";
    }

    /**
     * valores a ser introducidos en la base
     */
    protected function CltvoGetItems()
    {
        return [
            "home" => [
                'index'         => "main",
                'order'         => null,
                'parent_id'     => null,
                'tblank'        => false,
                'publish_id'    => $this->publish->id,
                'publish_at'    => date("Y-m-d"),
                'main'          => true,

                'translations'  => [
                    'en'        => [
                        'label'  => 'Main',
                    ],
                    'es'        => [
                        'label'  => 'Principal',
                    ],
                ],

            ]
        ];
    }

    /**
     * metodo de introduccion de valores
     * @param array   $page_args argumentos que definiran el
     * @param Command $comand     comando actual
     */
    protected function CltvoSower(array $page_args, Command $comand){

        $page = Page::where(["index" => $page_args["index"] ])->first();

        if(!$page){
            if ($this->createPage($page_args)) {
                $comand->line(  '<info>'.$page_args[$this->model_label].':</info>'." successfully set.");
            }else{
                $comand->error('<error>'.$page_args[$this->model_label].':</error>'." not successfully set.");
            }
        }else {
            $comand->line('<comment>'.$page_args[$this->model_label].':</comment>'." previously set.");
        }

    }

    protected function createPage(array $page_args)
    {
        $trasnlations = [];

        $trasnlations = $page_args["translations"];
        unset($page_args["translations"]);

        $page = Page::create($page_args) ;

        if(!$page){
            return false;
        }

        if ( isset($page_args["main"]) && $page_args["main"]) {
            if (!Page::getMainPage()) {
                $page->main = $page_args["main"];
                if(!$page->save()){
                    return false;
                }
            }
        }

        foreach ($this->languages as $language) {
            $translation = [
                    'slug'      => Page::generateUniqueSlug($trasnlations[$language->iso6391]['label']),
                    'label'     => $trasnlations[$language->iso6391]['label'],
            ];
            $page->updateTranslation($language, $translation);
        }

        return true;
    }

}
