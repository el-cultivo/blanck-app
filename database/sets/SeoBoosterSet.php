<?php
use App\Console\Cltvo\SetSite\CltvoSet;
use Illuminate\Console\Command;
use App\Models\Pages\Page;
use App\Models\Language;
use App\Models\Photo;

class SeoBoosterSet extends CltvoSet
{
    /**
     *  Etiqueta a desplegarse para informar al final
     */
    protected $label = 'Seo Booster';

    /**
     *  Nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass()
    {
        return 'App\Models\Settings\SeoBooster';
    }

    /**
     *  Valores a ser introducidos en la base de datos
     */
    protected function CltvoGetItems()
    {
        $resultado = array();
        $translations = array();

        foreach (Page::all() as $page)
        {
            foreach ($page->languages()->get() as $language)
            {
                $translations[$language->iso6391] = [
                    'title' => $language->label
                ];
            }

            array_push($resultado, [
                'route_name'    => 'client::pages.show',
                'parameters'    => $page->slug,
                'translations'  => $translations
            ]);
        }

        return $resultado;
    }

    /**
     *  Método de introducción de valores
     *  @param array   $model_args  Argumentos que definirán el sembrado
     *  @param Command $command     Comando actual
     */
    protected function CltvoSower(array $model_args, Command $command)
    {
        $model_class = $this->CltvoGetModelClass();

        $model = $model_class::where([
            'route_name' => $model_args['route_name'],
            'parameters' => $model_args['parameters']
        ])->first();

        if(!$model)
        {
            if ($this->createSeoBooster($model_class, $model_args))
            {
                $command->line('<info>' . $this->label . ':</info>' . ' successfully set.');
            }
            else
            {
                $command->error('<error>' . $this->label . ':</error>' . ' not successfully set.');
            }
        }
        else
        {
            $command->line('<comment>' . $this->label . ':</comment>' . ' previously set.');
        }
    }

    /**
     *  Método para la creación del Seo Booster
     *  @param array   $model_args  Argumentos que definirán el sembrado
     *  @param Command $command     Comando actual
     */
    protected function createSeoBooster($model_class, array $model_args)
    {
        $translations = $model_args['translations'];
        unset($model_args['translations']);

        $seo_booster = $model_class::create($model_args);

        if(!$seo_booster)
        {
            return false;
        }

        // Translations
        foreach (Language::available()->get() as $language)
        {
            $translation = [
                'title'         => $translations[$language->iso6391]['title'],
                'description'   => 'Description' // Pendiente
            ];

            $seo_booster->updateTranslation($language, $translation);
        }

        // Photos
        $photos = Photo::get();

        if(!$photos->isEmpty())
        {
            $seo_booster->associateImage($photos->random(1), ['use' => 'thumbnail']);
        }

        return true;
    }
}
