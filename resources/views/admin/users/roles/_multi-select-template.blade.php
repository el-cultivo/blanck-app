@extends('layouts.multi-select', [
	'select_plural'		=> 'roles',
	'form_id' 			=> $form_id,
	'form_method'		=> $form_method,
	'form_route'		=> $form_route,

	'option_value'		=> 'id',
	'option_label'		=> 'label',
])

@section('select-title')
    Roles
@overwrite
