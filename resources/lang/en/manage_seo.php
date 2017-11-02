<?php

return [
	'title'			=> 'Título',
	'description'	=> 'Descripción',
	'update' => [
		'success' => 'SEO has succesfully updated.'
	],
	'index' => [
		'instructions' => 'Manage SEO of pages without an associated model.',
		'table' => [
			'name' => 'Name',
			'route' => 'Route',
			'edit' => 'Edit',
		]
	],
	'create' => [
		'label' => 'Create SEO.',
		'instructions' => 'Create here the SEO of a page entering the route and the values ​​that will appear.',
		'form' => [
			'route_name' => [
				'label' => 'Route name',
				'placeholder' => 'client::pages.index',
			],
			'title' => [
				'label' => 'Title',
				'placeholder' => 'Welcome to ...',
			],
			'description' => [
				'label' => 'Description',
				'placeholder' => 'Lorem Ipsum Dolor Sit Amet',
			],
			'save' => 'Save'
		]
	],
	'edit' => [
		'label' => 'Edit SEO.',
		'instructions' => 'Edit the SEO of a page entering the values ​​that will appear.',
		'route' => 'URL',
		'form' => [
			'title' => [
				'label' => 'Title',
				'placeholder' => 'Welcome to ...',
			],
			'description' => [
				'label' => 'Description',
				'placeholder' => 'Lorem Ipsum Dolor Sit Amet',
			],
			'save' => 'Update'
		]
	]
];
