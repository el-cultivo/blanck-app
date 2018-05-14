<?php

namespace App\Http\Controllers\Traits;

trait DinamicMethodsTrait {

	protected static function getDinamicMethods()
	{
		return collect(preg_grep('/^'.static::DINAMIC_METHODS_PREFIX.'([A-Za-z0-9]*)'.static::DINAMIC_METHODS_SUFIX.'$/', get_class_methods(static::class)));
	}

	protected static function getAvailableDinamicMethods()
	{
		return static::getDinamicMethods()->map(function($method){
			return camel_case( preg_replace(['/^'.static::DINAMIC_METHODS_PREFIX."/",'/'.static::DINAMIC_METHODS_SUFIX."$/"],"",$method));
		});
	}

	public static function getAvailableDinamicMethodsImplode($glue = "|")
	{
		return static::getAvailableDinamicMethods()->implode($glue);
	}

	protected static function getDinamicMethodName($base_name)
	{
		return static::DINAMIC_METHODS_PREFIX.ucfirst(camel_case($base_name)).static::DINAMIC_METHODS_SUFIX;
	}

}
