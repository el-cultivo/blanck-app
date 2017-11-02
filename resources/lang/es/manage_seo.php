<?php

return [
	'title'			=> 'Título',
	'description'	=> 'Descripción',
	'update' => [
		'success' => 'El SEO se ha actualizado exitosamente.'
	],
	'index' => [
		'instructions' => 'Administrar SEO de páginas sin un modelo asociado.',
		'table' => [
			'name' => 'Nombre',
			'route' => 'Ruta',
			'edit' => 'Editar',
		]
	],
	'create' => [
		'label' => 'Crear SEO.',
		'instructions' => 'Crea aquí el SEO de una pagina ingresando la ruta y los valores que aparecerán en el SEO.',
		'form' => [
			'route_name' => [
				'label' => 'Nombre de ruta',
				'placeholder' => 'client::pages.index',
			],
			'title' => [
				'label' => 'Titulo',
				'placeholder' => 'Bienvenido a ...',
			],
			'description' => [
				'label' => 'Descripción',
				'placeholder' => 'Lorem Ipsum Dolor Sit Amet',
			],
			'save' => 'Guardar'
		]
	],
	'edit' => [
		'label' => 'Editar SEO.',
		'instructions' => 'Edita aquí el SEO de una pagina ingresando los valores que aparecerán en el SEO.',
		'route' => 'URL',
		'form' => [
			'title' => [
				'label' => 'Titulo',
				'placeholder' => 'Bienvenido a ...',
			],
			'description' => [
				'label' => 'Descripción',
				'placeholder' => 'Lorem Ipsum Dolor Sit Amet',
			],
			'save' => 'Actualizar'
		]
	]
];
