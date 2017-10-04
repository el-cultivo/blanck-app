<?php
use App\Console\Cltvo\SetSite\CltvoSet;
use Illuminate\Console\Command;
use App\Models\Settings\Shape;

class ShapeSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "Shapes";


    const SHAPES_BY_ROUTE =  [
        // "client::pages.index" => [ // key es la ruta y los valores del subarray los nombres de shapes,
        //     "header",
        // ]
    ];
    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return Shape::class;
    }

    /**
     * valores a ser introducidos en la base
     */
    protected function CltvoGetItems(){

        return collect( static::SHAPES_BY_ROUTE )->map(function($shapes,$route_name){
            return collect( $shapes )->map(function($shape_key) use ($route_name){
                return [
                    'route_name'    => $route_name,
                    'key'           => $shape_key,
                ];
            });
        })->collapse();
    }

    /**
     * metodo de introduccion de valores
     * @param array   $model_args argumentos que definiran el
     * @param Command $comand     comando actual
     */
    protected function CltvoSower(array $model_args, Command $comand){

        $model_class = $this->CltvoGetModelClass();

        $model = $model_class::where([
            'route_name'    => $model_args["route_name"],
            'key'           => $model_args["key"],
        ])->first();

        $reference_label = Shape::getVariableName($model_args["route_name"],$model_args["key"]);

        if(!$model){
            if ($model_class::create($model_args)) {
                $comand->line(  '<info>'.$reference_label.':</info>'." successfully set.");
            }else{
                $comand->error('<error>'.$reference_label.':</error>'." not successfully set.");
            }
        }else {
            $comand->line('<comment>'.$reference_label.':</comment>'." previously set.");
        }
    }

}
