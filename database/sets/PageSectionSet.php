<?php
use App\Console\Cltvo\SetSite\CltvoSet;
use Illuminate\Console\Command;

use App\Models\Pages\Sections\Section;
use App\Models\Pages\Sections\Type;

class PageSectionSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "Secciones de páginas";

	/**
     * etiqueta del display del modelo
     * @var string
     */
    protected $model_label =  "index";



    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return Section::class;
    }

    /**
     * valores a ser introducidos en la base
     */

	protected function CltvoGetItems(){
        $types = Type::get();

        $fija = $types->where("protected",false)
            ->where("unlimited",false)
            ->where("sortable",false)
            ->first();
        $ilimitada = $types->where('protected', false)
            ->where('unlimited', true)
            ->where('sortable', true)
            ->first();

		$limitada = $types->where('protected', false)
			->where('unlimited', false)
			->where('sortable', true)
			->first();

		$especial = $types->where('protected', true)
			->where('unlimited', false)
			->where('sortable', false)
			->first();

        return [
			[
				'index'             => 'contact-form',
				'template_path'     => 'contact_form',
				'components_max'    => null,
				'type_id'           => $especial->id,
				'editable_contents' => [
					'gallery_img'   => false,
					'thumbnail_img' => false,

					'title'         => false,
					'subtitle'      => false,
					'excerpt'       => false,
					'content'       => false,
					'iframe'        => false,
					'link'          => false
				],
				'description'       => 'Formulario de contacto',
			],
		// main
            // [
            //     'index'             => 'home-slider',
            //     'template_path'     => 'home.slider',
            //     'components_max'    =>  null,
            //     'type_id'           => $ilimitada->id,
            //     'editable_contents' => [
			// 		'gallery_img'   => false,
			//         'thumbnail_img' => true,
			//
			//         'title'         => false,
			//         'subtitle'      => false,
			//         'excerpt'       => true,
			//         'content'       => false,
			//         'iframe'        => true,
			//         'link'          => false
            //     ],
            //     'description'       => 'Slider de prueba' // debe ser un tml que se va a mostrar a los usuarios como intrucciones
            // ],
			// [
			// 	'index'             => 'home-logos',
			// 	'template_path'     => 'home.logos',
			// 	'components_max'    => null,
			// 	'type_id'           => $ilimitada->id,
			// 	'editable_contents' => [
			// 		'gallery_img'   => false,
			// 		'thumbnail_img' => true,
			//
			// 		'title'         => false,
			// 		'subtitle'      => false,
			// 		'excerpt'       => false,
			// 		'content'       => false,
			// 		'iframe'        => false,
			// 		'link'          => true
			// 	],
			// 	'description'       => 'reticula de logos de prueba' // debe ser un tml que se va a mostrar a los usuarios como intrucciones
			// ],
        ];
    }
	/**
	 * metodo de introduccion de valores
	 * @param array   $model_args argumentos que definiran el
	 * @param Command $comand     comando actual
	 */
	protected function CltvoSower(array $model_args, Command $comand){

		$model_class = $this->CltvoGetModelClass();

		$model = $model_class::where(['index'	=>	$model_args['index']])->get()->first();

		if(!$model){
				$model = $model_class::create($model_args);
			if ($model) {
				try {
					$componets = $model->all_components;
				} catch (Exception $e) {
					$comand->error('<error>'.$model_args[$this->model_label].':</error>'." components not successfully set.");
				}
				$comand->line(  '<info>'.$model_args[$this->model_label].':</info>'." successfully set.");
			}else{
				$comand->error('<error>'.$model_args[$this->model_label].':</error>'." not successfully set.");
			}
		}else {
			$comand->line('<comment>'.$model_args[$this->model_label].':</comment>'." previously set.");
		}
	}

}
