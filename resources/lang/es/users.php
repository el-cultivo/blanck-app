<?php
return [
	'first_name' => [
		'required'	=>	'El nombre es obligatorio',
		'max'	=>	'El nombre debe tener 255 caracteres como máximo',
	],
	'last_name' => [
		'required'	=>	'El apellido es obligatorio',
		'max'	=>	'El apellido debe tener 255 caracteres como máximo',
	],

	'email'   => [

		'required'  =>  'Es necesario que ingreses un correo electrónico',
		'email'     =>  'Ingresa un correo electrónico válido',
		'max'    =>  'El correo electrónico no puede exceder los 255 caracteres',
		'unique'    =>  'Este correo electrónico ya ha sido registrado',

	],

	'roles'   => [

		'required'  =>  'Asignar un rol es obligatorio',
		'exist'     =>  'El rol asignado no existe',
	],
];
