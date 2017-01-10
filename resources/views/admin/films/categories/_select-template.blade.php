@extends('layouts.select',[
	'select_id'			=> 'category_id',
	'select_label'		=> 'Categoría',
	'select_plural'		=> 'categories',
	'select_singular'	=> 'category',

	'option_value'		=> 'id',
	'option_label'		=> 'label',

	'default_value'		=> '',
	'default_label'		=> 'Ninguna',

	'form_id' 			=> $form_id,
	'model' 			=> $model,
	'required' 			=> $required
])

@section('modal-label')
	Agregar Categoría
@overwrite