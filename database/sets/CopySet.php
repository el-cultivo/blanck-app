<?php

use Illuminate\Console\Command;
use App\Models\Settings\Copy;

class CopySet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "Copies";


    const COPIES_BY_ROUTE =  [
        // "client::pages.index" => [ // key es la ruta y los valores del subarray los nombres de copys,
        //     "header",
        // ]
    ];
    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return Copy::class;
    }

    /**
     * valores a ser introducidos en la base
     */
    protected function CltvoGetItems(){

        return collect( static::COPIES_BY_ROUTE )->map(function($copies,$route_name){
            return collect( $copies )->map(function($copy_key) use ($route_name){
                return [
                    'route_name'    => $route_name,
                    'key'           => $copy_key,
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

        $reference_label = Copy::getVariableName($model_args["route_name"],$model_args["key"]);

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
